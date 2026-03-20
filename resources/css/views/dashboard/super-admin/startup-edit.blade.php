@extends('dashboard.layout')
@section('title', 'Edit – ' . $startup->company_name)

@section('dashboard_content')

<div class="mb-6 flex items-center gap-3">
    <a href="{{ route('dashboard.super-admin.startups') }}"
       class="w-8 h-8 rounded-lg flex items-center justify-center border hover:bg-gray-50 transition-colors flex-shrink-0"
       style="border-color:#e5e7eb;">
        <svg class="w-4 h-4" style="color:#6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </a>
    <div>
        <h1 class="text-2xl font-extrabold" style="color:#0d1b2a;">Edit Startup Profile</h1>
        <p class="text-sm font-semibold mt-0.5" style="color:#4b5563;">{{ $startup->company_name }}</p>
    </div>
</div>

@if($errors->any())
<div class="mb-5 bg-red-50 border border-red-200 rounded-xl p-4">
    <p class="text-xs font-extrabold text-red-600 mb-2">Please fix the following errors:</p>
    <ul class="list-disc list-inside space-y-1">
        @foreach($errors->all() as $error)
        <li class="text-xs font-semibold text-red-500">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@php
$inp = 'width:100%;border:1.5px solid #e5e7eb;border-radius:8px;padding:9px 12px;font-size:13px;font-weight:600;outline:none;background:#fff;';
$lbl = 'display:block;font-size:11px;font-weight:700;color:#374151;margin-bottom:4px;';
$req = '<span style="color:#ef4444;">*</span>';
@endphp

<form method="POST" action="{{ route('dashboard.super-admin.startups.update', $startup) }}" enctype="multipart/form-data">
    @csrf @method('PUT')

    <!-- ── Approval Status ── -->
    <div class="bg-white border rounded-xl p-5 mb-5" style="border-color:#e5e7eb;">
        <h2 class="text-sm font-extrabold mb-4" style="color:#1F3C88;">⚙ Approval Status</h2>
        <div style="max-width:200px;">
            <label style="{{ $lbl }}">Status {!! $req !!}</label>
            <select name="can_approved" style="{{ $inp }}">
                <option value="0" {{ $startup->can_approved==0?'selected':'' }}>⏳ Pending</option>
                <option value="1" {{ $startup->can_approved==1?'selected':'' }}>✓ Approved</option>
                <option value="2" {{ $startup->can_approved==2?'selected':'' }}>✗ Rejected</option>
            </select>
        </div>
    </div>

    <!-- ── Founder Details ── -->
    <div class="bg-white border rounded-xl p-5 mb-5" style="border-color:#e5e7eb;">
        <h2 class="text-sm font-extrabold mb-4" style="color:#1F3C88;">👤 Founder Details</h2>
        <div class="grid gap-4" style="grid-template-columns:1fr 1fr;">
            <div>
                <label style="{{ $lbl }}">Name {!! $req !!}</label>
                <input type="text" name="founder_name" value="{{ old('founder_name', $startup->founder_name) }}" style="{{ $inp }}">
            </div>
            <div>
                <label style="{{ $lbl }}">Gender {!! $req !!}</label>
                <select name="founder_gender" style="{{ $inp }}">
                    @foreach(['Male','Female','Other'] as $g)
                    <option value="{{ $g }}" {{ old('founder_gender',$startup->founder_gender)===$g?'selected':'' }}>{{ $g }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="{{ $lbl }}">Email {!! $req !!}</label>
                <input type="email" name="founder_email" value="{{ old('founder_email', $startup->founder_email) }}" style="{{ $inp }}">
            </div>
            <div>
                <label style="{{ $lbl }}">Contact {!! $req !!}</label>
                <input type="text" name="founder_contact" value="{{ old('founder_contact', $startup->founder_contact) }}" style="{{ $inp }}">
            </div>
            <div class="col-span-2">
                <label style="{{ $lbl }}">Background {!! $req !!}</label>
                <textarea name="founder_background" rows="3" style="{{ $inp }}">{{ old('founder_background', $startup->founder_background) }}</textarea>
            </div>
        </div>
    </div>

    <!-- ── Startup Details ── -->
    <div class="bg-white border rounded-xl p-5 mb-5" style="border-color:#e5e7eb;">
        <h2 class="text-sm font-extrabold mb-4" style="color:#1F3C88;">🚀 Startup Details</h2>
        <div class="grid gap-4" style="grid-template-columns:1fr 1fr;">
            <div>
                <label style="{{ $lbl }}">Company Name {!! $req !!}</label>
                <input type="text" name="company_name" value="{{ old('company_name', $startup->company_name) }}" style="{{ $inp }}">
            </div>
            <div>
                <label style="{{ $lbl }}">Stage {!! $req !!}</label>
                <select name="startup_stage" style="{{ $inp }}">
                    @foreach(['Ideation','Validation','Early Stage','Growth','Scaling'] as $s)
                    <option value="{{ $s }}" {{ old('startup_stage',$startup->startup_stage)===$s?'selected':'' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="{{ $lbl }}">State {!! $req !!}</label>
                <input type="text" name="state" value="{{ old('state', $startup->state) }}" style="{{ $inp }}">
            </div>
            <div>
                <label style="{{ $lbl }}">City {!! $req !!}</label>
                <input type="text" name="city" value="{{ old('city', $startup->city) }}" style="{{ $inp }}">
            </div>
            <div>
                <label style="{{ $lbl }}">Team Size {!! $req !!}</label>
                <input type="number" name="team_size" value="{{ old('team_size', $startup->team_size) }}" min="1" style="{{ $inp }}">
            </div>
            <div>
                <label style="{{ $lbl }}">Focus Areas {!! $req !!}</label>
                <input type="text" name="focus_areas" value="{{ old('focus_areas', $startup->focus_areas) }}" style="{{ $inp }}">
            </div>
            <div>
                <label style="{{ $lbl }}">DIPP Number {!! $req !!}</label>
                <input type="text" name="dipp_number" value="{{ old('dipp_number', $startup->dipp_number) }}" style="{{ $inp }}">
            </div>
            <div>
                <label style="{{ $lbl }}">Incorporation Date {!! $req !!}</label>
                <input type="date" name="incorporation_date" value="{{ old('incorporation_date', $startup->incorporation_date?->format('Y-m-d')) }}" style="{{ $inp }}">
            </div>
            <div>
                <label style="{{ $lbl }}">Incubated At</label>
                <input type="text" name="incubated_at" value="{{ old('incubated_at', $startup->incubated_at) }}" style="{{ $inp }}">
            </div>
            <div>
                <label style="{{ $lbl }}">Business Model {!! $req !!}</label>
                <input type="text" name="business_model" value="{{ old('business_model', $startup->business_model) }}" style="{{ $inp }}">
            </div>
            <div class="col-span-2">
                <label style="{{ $lbl }}">Product/Service Description {!! $req !!}</label>
                <textarea name="product_description" rows="3" style="{{ $inp }}">{{ old('product_description', $startup->product_description) }}</textarea>
            </div>
            <div>
                <label style="{{ $lbl }}">Problem Addressed {!! $req !!}</label>
                <textarea name="problem_addressed" rows="2" style="{{ $inp }}">{{ old('problem_addressed', $startup->problem_addressed) }}</textarea>
            </div>
            <div>
                <label style="{{ $lbl }}">Unique Idea {!! $req !!}</label>
                <textarea name="unique_idea" rows="2" style="{{ $inp }}">{{ old('unique_idea', $startup->unique_idea) }}</textarea>
            </div>
            <div>
                <label style="{{ $lbl }}">Key IP {!! $req !!}</label>
                <input type="text" name="key_ip" value="{{ old('key_ip', $startup->key_ip) }}" style="{{ $inp }}">
            </div>
            <div>
                <label style="{{ $lbl }}">Market Size {!! $req !!}</label>
                <input type="text" name="market_size" value="{{ old('market_size', $startup->market_size) }}" style="{{ $inp }}">
            </div>
            <div>
                <label style="{{ $lbl }}">Competitors {!! $req !!}</label>
                <input type="text" name="competitors" value="{{ old('competitors', $startup->competitors) }}" style="{{ $inp }}">
            </div>
        </div>
    </div>

    <!-- ── Investment ── -->
    <div class="bg-white border rounded-xl p-5 mb-5" style="border-color:#e5e7eb;">
        <h2 class="text-sm font-extrabold mb-4" style="color:#1F3C88;">💰 Investment & Revenue</h2>
        <div class="grid gap-4" style="grid-template-columns:1fr 1fr;">
            <div>
                <label style="{{ $lbl }}">Revenue Last FY (₹) {!! $req !!}</label>
                <input type="number" name="revenue_last_fy" value="{{ old('revenue_last_fy', $startup->revenue_last_fy) }}" min="0" step="0.01" style="{{ $inp }}">
            </div>
            <div>
                <label style="{{ $lbl }}">Total Revenue (₹) {!! $req !!}</label>
                <input type="number" name="total_revenue" value="{{ old('total_revenue', $startup->total_revenue) }}" min="0" step="0.01" style="{{ $inp }}">
            </div>
            <div>
                <label style="{{ $lbl }}">Fund Raised (₹)</label>
                <input type="number" name="fund_raised" value="{{ old('fund_raised', $startup->fund_raised) }}" min="0" step="0.01" style="{{ $inp }}">
            </div>
            <div>
                <label style="{{ $lbl }}">Fund Type</label>
                <select name="fund_type" style="{{ $inp }}">
                    <option value="">— Select —</option>
                    @foreach(['Bootstrapped','Angel','Seed','Series A','Series B','Grant','Other'] as $ft)
                    <option value="{{ $ft }}" {{ old('fund_type',$startup->fund_type)===$ft?'selected':'' }}>{{ $ft }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="{{ $lbl }}">Capital Seeking (₹) {!! $req !!}</label>
                <input type="number" name="capital_seeking" value="{{ old('capital_seeking', $startup->capital_seeking) }}" min="0" step="0.01" style="{{ $inp }}">
            </div>
            <div>
                <label style="{{ $lbl }}">Govt Grant Name</label>
                <input type="text" name="govt_grant_name" value="{{ old('govt_grant_name', $startup->govt_grant_name) }}" style="{{ $inp }}">
            </div>
            <div>
                <label style="{{ $lbl }}">Govt Grant Amount (₹)</label>
                <input type="number" name="govt_grant_amount" value="{{ old('govt_grant_amount', $startup->govt_grant_amount) }}" min="0" step="0.01" style="{{ $inp }}">
            </div>
        </div>

        <!-- PDF uploads -->
        <div class="grid gap-4 mt-4" style="grid-template-columns:1fr 1fr 1fr;">
            @foreach(['fund_utilization_pdf'=>'Fund Utilization PDF','pitch_deck_pdf'=>'Pitch Deck PDF','incorporation_certificate_pdf'=>'Incorporation Certificate'] as $field=>$label)
            <div>
                <label style="{{ $lbl }}">{{ $label }}</label>
                @if($startup->$field)
                <a href="{{ Storage::url($startup->$field) }}" target="_blank"
                   class="block text-xs font-bold mb-1" style="color:#1F3C88;">📄 View current</a>
                @endif
                <input type="file" name="{{ $field }}" accept=".pdf"
                    style="width:100%;font-size:12px;font-weight:600;color:#374151;">
                <p class="text-xs mt-1" style="color:#9ca3af;">Leave blank to keep existing</p>
            </div>
            @endforeach
        </div>
    </div>

    <!-- ── Social ── -->
    <div class="bg-white border rounded-xl p-5 mb-5" style="border-color:#e5e7eb;">
        <h2 class="text-sm font-extrabold mb-4" style="color:#1F3C88;">🔗 Social Media</h2>
        <div class="grid gap-4" style="grid-template-columns:1fr 1fr;">
            @foreach(['website'=>'Website','linkedin'=>'LinkedIn','instagram'=>'Instagram','facebook'=>'Facebook','twitter'=>'Twitter'] as $field=>$label)
            <div>
                <label style="{{ $lbl }}">{{ $label }}</label>
                <input type="url" name="{{ $field }}" value="{{ old($field, $startup->$field) }}" style="{{ $inp }}" placeholder="https://...">
            </div>
            @endforeach
        </div>
    </div>

    <!-- Submit -->
    <div class="flex items-center gap-3">
        <button type="submit"
            class="px-6 py-2.5 rounded-lg text-sm font-bold text-white"
            style="background:#1F3C88;">
            💾 Save Changes
        </button>
        <a href="{{ route('dashboard.super-admin.startups') }}"
           class="px-6 py-2.5 rounded-lg text-sm font-bold border"
           style="color:#6b7280;border-color:#e5e7eb;">
            Cancel
        </a>
    </div>
</form>

@endsection
