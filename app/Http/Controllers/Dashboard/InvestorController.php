<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\InvestorProfile;
use App\Models\StartupProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvestorController extends Controller
{
    public function index()
    {
        return view('dashboard.investor.index');
    }

    public function browseStartups(Request $request)
    {
        $q        = $request->input('q', '');
        $startups = StartupProfile::where('can_approved', 1)
            ->when($q, fn($query) => $query->where(function ($sub) use ($q) {
                $sub->where('company_name',    'like', "%{$q}%")
                    ->orWhere('founder_name',   'like', "%{$q}%")
                    ->orWhere('focus_areas',    'like', "%{$q}%")
                    ->orWhere('startup_stage',  'like', "%{$q}%")
                    ->orWhere('founder_contact','like', "%{$q}%")
                    ->orWhere('state',          'like', "%{$q}%");
            }))
            ->latest()->paginate(9)->withQueryString();

        return view('dashboard.investor.browse-startups', compact('startups', 'q'));
    }

    public function showProfile()
    {
        $investorProfile = InvestorProfile::where('user_id', auth()->id())->first();
        $domains = Domain::orderBy('name')->get();
        return view('dashboard.investor.profile', compact('investorProfile', 'domains'));
    }

    public function storeProfile(Request $request)
    {
        $existing = InvestorProfile::where('user_id', auth()->id())->first();

        $rules = [
            'fund_name'              => 'required|string|max:255',
            'fund_email'             => 'required|email|max:255',
            'fund_mobile_number'     => 'required|string|max:20',
            'fund_brief'             => 'required|string',
            'partner_name'           => 'required|string|max:255',
            'partner_email'          => 'required|email|max:255',
            'partner_mobile_number'  => 'required|string|max:20',
            'ticket_size'            => 'required|numeric|min:0',
            'investment_sectors'     => 'required|array|min:1',
            'investment_sectors.*'   => 'integer|exists:domains,id',
            'portfolio_companies'    => 'nullable|string',
            'city'                   => 'required|string|max:100',
            'state'                  => 'required|string|max:100',
            'website'                => 'nullable|url|max:255',
            'logo'                   => $existing ? 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' : 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'founder_img'            => $existing ? 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' : 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $validated = $request->validate($rules);

        // Handle file uploads
        foreach (['logo', 'founder_img'] as $field) {
            if ($request->hasFile($field)) {
                if ($existing && $existing->$field) {
                    Storage::disk('public')->delete($existing->$field);
                }
                $validated[$field] = $request->file($field)->store('investor-uploads', 'public');
            } elseif ($existing) {
                $validated[$field] = $existing->$field;
            }
        }

        $validated['user_id'] = auth()->id();
        $validated['can_approved'] = 0; // Pending approval

        if ($existing) {
            $existing->update($validated);
        } else {
            InvestorProfile::create($validated);
        }

        return redirect()->route('dashboard.investor.profile')
            ->with('success', $existing
                ? 'Your investor profile has been updated successfully.'
                : 'Your investor profile has been submitted for approval!');
    }

    public function showStartups(string $hash)
    {
        $id = decrypt($hash);
        $startup = StartupProfile::findOrFail($id);
        abort_unless($startup->can_approved, 404);
        $startup->load('user');
        $domainMap = Domain::pluck('name', 'id');
        return view('dashboard.investor.show-startup', compact('startup', 'domainMap'));
    }
}
