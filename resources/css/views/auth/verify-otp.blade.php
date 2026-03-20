<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email – StartupEco</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .otp-box {
            width: 52px; height: 60px; border: 1.5px solid #e5e7eb; border-radius: 12px;
            text-align: center; font-size: 22px; font-weight: 700; outline: none;
            transition: all .2s; background: #fafafa; color: #1a1a2e; caret-color: #57BD68;
        }
        .otp-box:focus { border-color: #57BD68; box-shadow: 0 0 0 3px rgba(87,189,104,0.15); background: #fff; }
        .otp-box.filled { border-color: #57BD68; background: #f0fdf4; }
        .btn-primary {
            width: 100%; background: #57BD68; color: #fff; font-weight: 600;
            padding: 13px; border-radius: 10px; font-size: 14px; border: none;
            cursor: pointer; transition: background .2s;
        }
        .btn-primary:hover { background: #2F8F46; }
        .btn-outline {
            width: 100%; background: transparent; color: #57BD68; font-weight: 600;
            padding: 11px; border-radius: 10px; font-size: 14px;
            border: 1.5px solid #57BD68; cursor: pointer; transition: all .2s;
        }
        .btn-outline:hover { background: #57BD68; color: #fff; }
        .alert-error   { background:#fef2f2; border:1px solid #fecaca; color:#dc2626; border-radius:8px; padding:12px 16px; font-size:13px; margin-bottom:16px; }
        .alert-success { background:#edfff1; border:1px solid #A7E4B5; color:#2F8F46;  border-radius:8px; padding:12px 16px; font-size:13px; margin-bottom:16px; }
        .alert-info    { background:#eff6ff; border:1px solid #bfdbfe; color:#1d4ed8;  border-radius:8px; padding:12px 16px; font-size:13px; margin-bottom:16px; }
        .panel { background: linear-gradient(160deg, #0d1b2a 0%, #1F3C88 60%, #0f3318 100%); }
    </style>
</head>
<body class="min-h-screen flex" style="background:#F7F9FC;">

<div class="flex w-full min-h-screen">

    <!-- Left Panel -->
    <div class="panel hidden lg:flex lg:w-5/12 xl:w-1/2 flex-col justify-between p-12 relative overflow-hidden">
        <div style="position:absolute;width:400px;height:400px;border-radius:50%;border:1px solid rgba(255,255,255,0.05);top:-100px;left:-100px;"></div>

        <a href="/" class="flex items-center gap-2 relative z-10">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:#57BD68;">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <span class="text-xl font-bold text-white">Startup<span style="color:#57BD68;">Eco</span></span>
        </a>

        <div class="relative z-10 text-center">
            <!-- Email icon -->
            <div class="w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-8" style="background:rgba(87,189,104,0.15);">
                <svg class="w-12 h-12" style="color:#57BD68;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-white mb-3">Check your inbox</h2>
            <p class="text-gray-400 text-sm leading-relaxed max-w-xs mx-auto mb-8">
                We've sent a 6-digit verification code to your email address. It expires in 10 minutes.
            </p>

            <!-- Steps -->
            <div class="space-y-3 text-left max-w-xs mx-auto">
                @foreach([
                    ['1','Open your email app','#57BD68'],
                    ['2','Find the email from StartupEco','#FF8C42'],
                    ['3','Enter the 6-digit code','#1F3C88'],
                ] as [$step,$text,$color])
                <div class="flex items-center gap-3 rounded-xl p-3" style="background:rgba(255,255,255,0.05);">
                    <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold text-white flex-shrink-0" style="background:{{ $color }};">{{ $step }}</div>
                    <span class="text-gray-300 text-sm">{{ $text }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <div class="relative z-10 rounded-2xl p-4 text-center" style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08);">
            <p class="text-gray-400 text-xs">Check spam/junk folder if you don't see the email within 2 minutes.</p>
        </div>
    </div>

    <!-- Right Form Panel -->
    <div class="flex-1 flex flex-col justify-center items-center px-6 py-12 bg-white">
        <div class="w-full max-w-md">

            <!-- Mobile logo -->
            <a href="/" class="flex items-center gap-2 mb-8 lg:hidden">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#57BD68;">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <span class="text-lg font-bold" style="color:#1a1a2e;">Startup<span style="color:#57BD68;">Eco</span></span>
            </a>

            <!-- Icon -->
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5" style="background:#f0fdf4;">
                <svg class="w-7 h-7" style="color:#57BD68;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>

            <h2 class="text-2xl font-bold mb-1" style="color:#1a1a2e;">Verify your email</h2>
            <p class="text-gray-500 text-sm mb-2">Enter the 6-digit code sent to</p>
            <p class="font-semibold text-sm mb-7" style="color:#1F3C88;">{{ session('email') ?? 'your email address' }}</p>

            <!-- Alerts -->
            @if(session('info'))
            <div class="alert-info">{{ session('info') }}</div>
            @endif
            @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
            <div class="alert-error">{{ $errors->first() }}</div>
            @endif

            <!-- OTP Form -->
            <form method="POST" action="{{ route('otp.verify') }}" id="otpForm">
                @csrf
                <input type="hidden" name="email" value="{{ session('email') ?? old('email') }}">
                <input type="hidden" name="otp" id="otpHidden">

                <!-- 6 digit boxes -->
                <div class="flex gap-2 justify-center mb-6" id="otpBoxes">
                    @for($i = 0; $i < 6; $i++)
                    <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]"
                        class="otp-box" id="otp{{ $i }}"
                        oninput="otpInput(this, {{ $i }})"
                        onkeydown="otpKeydown(event, {{ $i }})"
                        onpaste="{{ $i === 0 ? 'handlePaste(event)' : 'return false' }}">
                    @endfor
                </div>

                <!-- Timer -->
                <div class="text-center mb-5">
                    <p class="text-xs text-gray-400">Code expires in <span id="timer" class="font-semibold" style="color:#FF8C42;">10:00</span></p>
                </div>

                <button type="submit" class="btn-primary" id="verifyBtn" disabled
                    style="opacity:0.5; cursor:not-allowed;">
                    Verify Email →
                </button>
            </form>

            <!-- Resend -->
            <div class="mt-5 pt-5 border-t" style="border-color:#f3f4f6;">
                <p class="text-center text-xs text-gray-400 mb-3">Didn't receive the code?</p>
                <form method="POST" action="{{ route('otp.resend') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ session('email') ?? old('email') }}">
                    <button type="submit" class="btn-outline">Resend OTP</button>
                </form>
            </div>

            <p class="text-center text-xs text-gray-400 mt-5">
                Wrong account? <a href="/register" class="font-semibold" style="color:#57BD68;">Register again</a>
                &nbsp;·&nbsp;
                <a href="/login" class="font-semibold" style="color:#57BD68;">Back to login</a>
            </p>
        </div>
    </div>
</div>

<script>
// OTP box logic
function otpInput(el, idx) {
    el.value = el.value.replace(/[^0-9]/g, '');
    if (el.value) {
        el.classList.add('filled');
        if (idx < 5) document.getElementById('otp' + (idx + 1)).focus();
    } else {
        el.classList.remove('filled');
    }
    syncOtp();
}

function otpKeydown(e, idx) {
    if (e.key === 'Backspace' && !e.target.value && idx > 0) {
        document.getElementById('otp' + (idx - 1)).focus();
    }
}

function handlePaste(e) {
    e.preventDefault();
    const text = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '').slice(0, 6);
    text.split('').forEach((ch, i) => {
        const box = document.getElementById('otp' + i);
        if (box) { box.value = ch; box.classList.add('filled'); }
    });
    const last = Math.min(text.length, 5);
    document.getElementById('otp' + last).focus();
    syncOtp();
}

function syncOtp() {
    let val = '';
    for (let i = 0; i < 6; i++) val += (document.getElementById('otp' + i).value || '');
    document.getElementById('otpHidden').value = val;
    const btn = document.getElementById('verifyBtn');
    if (val.length === 6) {
        btn.disabled = false;
        btn.style.opacity = '1';
        btn.style.cursor = 'pointer';
    } else {
        btn.disabled = true;
        btn.style.opacity = '0.5';
        btn.style.cursor = 'not-allowed';
    }
}

// Countdown timer
let seconds = 600;
const timerEl = document.getElementById('timer');
const interval = setInterval(() => {
    seconds--;
    if (seconds <= 0) {
        clearInterval(interval);
        timerEl.textContent = 'Expired';
        timerEl.style.color = '#ef4444';
        return;
    }
    const m = Math.floor(seconds / 60).toString().padStart(2, '0');
    const s = (seconds % 60).toString().padStart(2, '0');
    timerEl.textContent = m + ':' + s;
    if (seconds <= 60) timerEl.style.color = '#ef4444';
}, 1000);

// Focus first box on load
document.getElementById('otp0').focus();
</script>
</body>
</html>
