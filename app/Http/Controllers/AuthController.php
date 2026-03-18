<?php

namespace App\Http\Controllers;

use App\Mail\OtpMail;
use App\Models\User;
use App\Models\RoleSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // ── Registration ────────────────────────────────────────────────────────

    public function showRegister()
    {
        $activeRoles = RoleSetting::activeRoles();
        $roles = array_filter(
            User::roles(),
            fn($key) => $key !== 'super_admin' && in_array($key, $activeRoles),
            ARRAY_FILTER_USE_KEY
        );
        return view('auth.register', ['roles' => $roles]);
    }

    public function register(Request $request)
    {
        $activeRoles = RoleSetting::activeRoles();
        $allowedRoles = array_filter(
            array_keys(User::roles()),
            fn($r) => $r !== 'super_admin' && in_array($r, $activeRoles)
        );
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'role'     => 'required|in:' . implode(',', $allowedRoles),
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
        ]);

        $otp  = $this->generateOtp();
        $user = User::create([
            'name'           => $request->name,
            'email'          => $request->email,
            'role'           => $request->role,
            'password'       => $request->password,
            'is_verified'    => false,
            'otp'            => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new OtpMail($otp, $user->name));

        return redirect()->route('otp.verify.form')
            ->with('email', $user->email)
            ->with('info', 'Registration successful! Please check your email for the OTP.');
    }

    // ── OTP Verification ────────────────────────────────────────────────────

    public function showVerifyOtp()
    {
        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp'   => 'required|digits:6',
        ]);

        // Rate limit: 5 attempts per email per minute
        $key = 'otp:' . $request->email;
        if (RateLimiter::tooManyAttempts($key, 5)) {
            return back()->withErrors(['otp' => 'Too many attempts. Please wait a minute.']);
        }

        $user = User::where('email', $request->email)->first();

        if ($user->is_verified) {
            return redirect()->route('login')->with('info', 'Already verified. Please login.');
        }

        if ($user->otp !== $request->otp || now()->isAfter($user->otp_expires_at)) {
            RateLimiter::hit($key, 60);
            return back()->withErrors(['otp' => 'Invalid or expired OTP. Please try again.'])->withInput();
        }

        $user->update([
            'is_verified'    => true,
            'otp'            => null,
            'otp_expires_at' => null,
        ]);

        RateLimiter::clear($key);

        return redirect()->route('login')->with('success', 'Email verified! You can now log in.');
    }

    public function resendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $key = 'resend:' . $request->email;
        if (RateLimiter::tooManyAttempts($key, 3)) {
            return back()->withErrors(['email' => 'Too many resend attempts. Please wait.']);
        }

        $user = User::where('email', $request->email)->first();

        if ($user->is_verified) {
            return redirect()->route('login');
        }

        $otp = $this->generateOtp();
        $user->update(['otp' => $otp, 'otp_expires_at' => now()->addMinutes(10)]);
        Mail::to($user->email)->send(new OtpMail($otp, $user->name));

        RateLimiter::hit($key, 60);

        return back()->with('success', 'A new OTP has been sent to your email.');
    }

    // ── Login ────────────────────────────────────────────────────────────────

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Rate limit: 5 login attempts per IP per minute
        $key = 'login:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            return back()->withErrors(['email' => 'Too many login attempts. Please wait a minute.']);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            RateLimiter::hit($key, 60);
            return back()->withErrors(['email' => 'No account found with this email.'])->withInput();
        }

        // Not verified — send fresh OTP and redirect to verify
        if (!$user->is_verified) {
            $otp = $this->generateOtp();
            $user->update(['otp' => $otp, 'otp_expires_at' => now()->addMinutes(10)]);
            Mail::to($user->email)->send(new OtpMail($otp, $user->name));

            return redirect()->route('otp.verify.form')
                ->with('email', $user->email)
                ->with('info', 'Your account is not verified. A new OTP has been sent to your email.');
        }

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            RateLimiter::hit($key, 60);
            return back()->withErrors(['email' => 'Incorrect password.'])->withInput();
        }

        RateLimiter::clear($key);
        $request->session()->regenerate();

        return redirect(Auth::user()->dashboardRoute());
    }

    // ── Logout ───────────────────────────────────────────────────────────────

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // ── Helper ───────────────────────────────────────────────────────────────

    private function generateOtp(): string
    {
        return str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }
}
