<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\StartupSubmissionMail;
use App\Models\Domain;
use App\Models\StartupProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class StartupProfileController extends Controller
{
    public function show()
    {
        $startupProfile = StartupProfile::where('user_id', auth()->id())->first();
        $user = auth()->user();
        $domains = Domain::orderBy('name')->get();
        return view('startup.startup-profile', compact('startupProfile', 'user', 'domains'));
    }

    public function store(Request $request)
    {
        $existing = StartupProfile::where('user_id', auth()->id())->first();

        $rules = [
            'name'               => 'required|string|max:255',
            'mobile'             => 'required|string|max:20',
            'address'            => 'nullable|string',
            'logo'               => $existing ? 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' : 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            'founder_name'       => 'required|string|max:255',
            'founder_gender'     => 'required|in:Male,Female,Other',
            'founder_email'      => 'required|email|max:255',
            'founder_contact'    => 'required|string|max:20',
            'founder_background' => 'required|string',

            'co_founders'              => 'nullable|array',
            'co_founders.*.name'       => 'nullable|string|max:255',
            'co_founders.*.gender'     => 'nullable|in:Male,Female,Other',
            'co_founders.*.email'      => 'nullable|email|max:255',
            'co_founders.*.contact'    => 'nullable|string|max:20',
            'co_founders.*.role'       => 'nullable|string|max:255',
            'co_founders.*.background' => 'nullable|string',

            'company_name'        => 'required|string|max:255',
            'startup_stage'       => 'required|in:Ideation: You have just an idea,Proof of Concept (PoC): You have worked towards the idea to create a PoC.,Prototype/Minimum Viable Product (MVP): You have created a prototype/MVP and ready for pilot runs.,Early Revenue: You have just entered the market and generating business.,Scaling',
            'state'               => 'required|string|max:100',
            'city'                => 'required|string|max:100',
            'team_size'           => 'required|integer|min:1',
            'focus_areas'         => 'required|string|max:255',
            'product_description' => 'required|string|max:5000',
            'problem_addressed'   => 'required|string',
            'unique_idea'         => 'required|string',
            'key_ip'              => 'required|string',
            'revenue_last_fy'     => 'required|numeric|min:0',
            'total_revenue'       => 'required|numeric|min:0',
            'market_size'         => 'required|string',
            'competitors'         => 'required|string',
            'business_model'      => 'required|string',
            'incorporation_date'  => 'required|date',
            'dipp_number'         => 'required|string|max:100',
            'incubated_at'        => 'nullable|string|max:255',
            'govt_grant_name'     => 'nullable|string|max:255',
            'govt_grant_amount'   => 'nullable|numeric|min:0',

            'fund_raised'     => 'nullable|numeric|min:0',
            'fund_type'       => 'nullable|in:Bootstrapped,Angel,Seed,Series A,Series B,Grant,Other',
            'capital_seeking' => 'required|numeric|min:0',

            'fund_utilization_pdf'          => $existing ? 'nullable|file|mimes:pdf|max:10240' : 'required|file|mimes:pdf|max:10240',
            'pitch_deck_pdf'                => $existing ? 'nullable|file|mimes:pdf|max:10240' : 'required|file|mimes:pdf|max:10240',
            'incorporation_certificate_pdf' => $existing ? 'nullable|file|mimes:pdf|max:10240' : 'required|file|mimes:pdf|max:10240',

            'website'   => 'nullable|url|max:255',
            'linkedin'  => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'facebook'  => 'nullable|url|max:255',
            'twitter'   => 'nullable|url|max:255',

        ];

        $validated = $request->validate($rules);

        // Handle file uploads
        foreach (['fund_utilization_pdf', 'pitch_deck_pdf', 'incorporation_certificate_pdf'] as $field) {
            if ($request->hasFile($field)) {
                if ($existing && $existing->$field) {
                    Storage::disk('public')->delete($existing->$field);
                }
                $validated[$field] = $request->file($field)->store('startup-docs', 'public');
            } elseif ($existing) {
                $validated[$field] = $existing->$field;
            }
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            if ($existing && $existing->logo) {
                Storage::disk('public')->delete($existing->logo);
            }
            $validated['logo'] = $request->file('logo')->store('startup-logos', 'public');
        } elseif ($existing) {
            $validated['logo'] = $existing->logo;
        }

        $coFounders = collect($request->input('co_founders', []))
            ->filter(fn($cf) => !empty($cf['name']))->values()->toArray();
        $validated['co_founders'] = empty($coFounders) ? null : $coFounders;
        $validated['user_id']     = auth()->id();
        $validated['declaration'] = true;

        if ($existing) {
            $existing->update($validated);
        } else {
            $validated['can_approved'] = 0;
            $profile = StartupProfile::create($validated);
            try {
                Mail::to(auth()->user()->email)->send(new StartupSubmissionMail($profile));
            } catch (\Exception $e) {}
        }

        return redirect()->route('dashboard.startup.profile')
            ->with('success', $existing
                ? 'Your startup profile has been updated successfully.'
                : 'Your startup profile has been submitted! A confirmation email has been sent.');
    }
}
