@extends('dashboard.layout')
@section('title', 'Startup Details Form')

@section('dashboard_content')
<style>
/* ===== Page Layout ===== */
.profile-edit-page {
    max-width: 100%;
    margin: 0;
    width: 100%;
}

.content-wrapper--profile-edit {
    margin-left: 0 !important;
    margin-right: 0 !important;
    padding-left: 20px !important;
    padding-right: 20px !important;
}

/* ===== Header ===== */
.profile-edit-header {
    text-align: center;
    margin-bottom: 2rem;
    padding: 1.8rem;
    background: linear-gradient(135deg, #1d2531 0%, #263544 100%);
    border-radius: 16px;
    color: #fff;
    box-shadow: 0 10px 30px rgba(29, 37, 49, 0.25);
}

.profile-edit-header h1 {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0 0 0.4rem 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.6rem;
}

.profile-edit-header .subtitle {
    font-size: 0.95rem;
    opacity: 0.9;
}

/* ===== Card ===== */
.profile-form-card {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 6px 22px rgba(0, 0, 0, 0.06);
    border: 1px solid #e8ecf1;
    overflow: hidden;
    margin-bottom: 1.6rem;
}

/* ===== Section Header ===== */
.profile-form-card .section-header {
    padding: 1rem 1.4rem;
    background: linear-gradient(to right, #f8fafc, #f1f5f9);
    border-bottom: 2px solid #e2e8f0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.profile-form-card .section-header .section-num {
    width: 32px;
    height: 32px;
    border-radius: 10px;
    background: #1d2531;
    color: #fff;
    font-weight: 700;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.profile-form-card .section-header h5 {
    margin: 0;
    font-size: 1.05rem;
    font-weight: 600;
    color: #1e293b;
}

/* ===== Body ===== */
.profile-form-card .section-body {
    padding: 1.4rem 1.6rem;
}

.profile-form-card .section-body .row {
    --bs-gutter-x: 1.3rem;
    --bs-gutter-y: 1rem;
}

/* ===== Labels ===== */
.profile-edit-form .form-label {
    font-weight: 600;
    color: #334155;
    font-size: 0.9rem;
    margin-bottom: 0.4rem;
}

/* ===== Inputs ===== */
.profile-edit-form .form-control,
.profile-edit-form .form-select {
    border-radius: 10px;
    border: 1px solid #cbd5e1;
    padding: 0.65rem 0.95rem;
    font-size: 0.95rem;
    line-height: 1.5;
    height: 46px;
    color: #334155;
    transition: border-color 0.25s ease, box-shadow 0.25s ease;
    background: #fff;
    width: 100%;
    display: block;
}

.profile-edit-form .form-control:focus,
.profile-edit-form .form-select:focus {
    border-color: #1d2531;
    box-shadow: 0 0 0 3px rgba(29, 37, 49, 0.12);
    outline: none;
}

/* Placeholder */
.profile-edit-form .form-control::placeholder {
    color: #94a3b8;
    font-size: 0.9rem;
}

/* Select arrow alignment */
.profile-edit-form .form-select {
    padding-right: 2.25rem;
    appearance: auto;
}

/* Textarea */
.profile-edit-form textarea.form-control {
    height: auto;
    min-height: 95px;
    resize: vertical;
    line-height: 1.6;
}

/* File Input */
.profile-edit-form .form-control[type="file"] {
    padding: 0.5rem 0.75rem;
    background: #f8fafc;
    cursor: pointer;
    line-height: 1.6;
}

/* Date Input */
.profile-edit-form .form-control[type="date"] {
    color: #334155;
}

/* Number Input — hide spinners */
.profile-edit-form .form-control[type="number"] {
    -moz-appearance: textfield;
}
.profile-edit-form .form-control[type="number"]::-webkit-outer-spin-button,
.profile-edit-form .form-control[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Other Domain Field */
#otherDomainField {
    display: none;
    margin-top: 0.75rem;
}

#otherDomainField label {
    font-weight: 600;
    color: #334155;
    font-size: 0.9rem;
    margin-bottom: 0.4rem;
    display: block;
}

/* ===== File Preview ===== */
.current-file {
    margin-top: 0.5rem;
    padding: 0.6rem 0.85rem;
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    border-radius: 8px;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.current-file .file-hint {
    font-size: 0.8rem;
    color: #166534;
    font-weight: 500;
}

/* ===== Divider ===== */
.profile-edit-form hr.section-divider {
    border: 0;
    height: 1px;
    background: linear-gradient(to right, transparent, #e2e8f0, transparent);
    margin: 1.6rem 0;
}

/* ===== Character Count ===== */
.profile-edit-form .char-count {
    font-size: 0.8rem;
    color: #64748b;
    margin-top: 0.3rem;
}

/* ===== Co-Founder Blocks ===== */
.cofounder-block {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 1.1rem 1.25rem;
    margin-bottom: 1rem;
}

.cofounder-block-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    border-bottom: 1px solid #e2e8f0;
    padding-bottom: 0.5rem;
}

.cofounder-block-title {
    font-weight: 600;
    color: #475569;
}

/* Remove button */
.btn-remove-cofounder {
    color: #dc2626;
    border: 1px solid #fecaca;
    border-radius: 8px;
    padding: 0.35rem 0.7rem;
    font-size: 0.85rem;
    background: transparent;
}

.btn-remove-cofounder:hover {
    background: #fef2f2;
    color: #b91c1c;
}

/* Add button */
#btn-add-cofounder {
    border-style: dashed;
    border-width: 2px;
    border-radius: 10px;
    padding: 0.6rem 1.2rem;
}

/* ===== Actions ===== */
.profile-edit-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    align-items: center;
    padding: 1.3rem 1.6rem;
    background: #f8fafc;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
}

.profile-edit-actions .btn {
    padding: 0.6rem 1.4rem;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.2s ease;
}

.profile-edit-actions .btn:hover {
    transform: translateY(-1px);
}

/* Primary button */
.profile-edit-actions .btn-primary {
    background: #1d2531;
    border-color: #1d2531;
    box-shadow: 0 4px 12px rgba(29, 37, 49, 0.3);
}

.profile-edit-actions .btn-primary:hover {
    box-shadow: 0 6px 16px rgba(29, 37, 49, 0.35);
}

/* ===== Responsive ===== */
@media (max-width: 768px) {
    .profile-edit-header h1 {
        font-size: 1.4rem;
        flex-wrap: wrap;
    }

    .profile-form-card .section-body {
        padding: 1rem;
    }

    .profile-edit-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .profile-edit-actions .btn {
        width: 100%;
        text-align: center;
    }
}
</style>

<div class="profile-edit-page">
    <div class="profile-edit-header">
        <p class="subtitle mb-0">Startup Profile</p>
        <p class="subtitle mb-0">Keep your startup information up to date for investors</p>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('dashboard.startup.profile.store') }}" enctype="multipart/form-data" class="profile-edit-form">
        @csrf

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Basic Info -->
        <div class="profile-form-card">
            <div class="section-header">
                <span class="section-num"><i class="fas fa-info-circle" style="font-size:0.85rem"></i></span>
                <h5>Basic Information</h5>
            </div>
            <div class="section-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required value="{{ old('name', $startupProfile->name ?? '') }}">
                            @error('name')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mobile</label>
                            <input type="text" name="mobile" class="form-control" maxlength="10" inputmode="numeric" pattern="[0-9]{1,10}" title="Max 10 digits" required value="{{ old('mobile', $startupProfile->mobile ?? '') }}">
                            @error('mobile')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Logo</label>
                            <input type="file" name="logo" class="form-control" accept="image/*">
                            @error('logo')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                            @if(!empty(trim($startupProfile->logo ?? '')))
                            <div class="current-file">
                                <span class="file-hint"><i class="fas fa-file-image text-success me-1"></i> Current: {{ basename($startupProfile->logo) }}</span>
                                <a href="{{ asset('storage/'.$startupProfile->logo) }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-success"><i class="fas fa-external-link-alt me-1"></i>View</a>
                            </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="3">{{ old('address', $startupProfile->address ?? '') }}</textarea>
                            @error('address')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
            </div>
        </div>

        <!-- Founder Details -->
        <div class="profile-form-card">
            <div class="section-header">
                <span class="section-num">1</span>
                <h5>Founder Details</h5>
            </div>
            <div class="section-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-3">
                            <label class="form-label">Name of Founder *</label>
                            <input type="text" name="founder_name" class="form-control" required value="{{ old('founder_name', $startupProfile->founder_name ?? '') }}">
                            @error('founder_name')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Founder Gender *</label>
                            <select name="founder_gender" class="form-select" required>
                                <option value="">Select</option>
                                <option value="Male" {{ old('founder_gender', $startupProfile->founder_gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('founder_gender', $startupProfile->founder_gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('founder_gender', $startupProfile->founder_gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('founder_gender')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Founder Contact Number *</label>
                            <input type="text" name="founder_contact" class="form-control" maxlength="10" inputmode="numeric" pattern="[0-9]{1,10}" title="Max 10 digits" required value="{{ old('founder_contact', $startupProfile->founder_contact ?? '') }}">
                            @error('founder_contact')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Founder Email Address *</label>
                            <input type="email" name="founder_email" class="form-control" required value="{{ old('founder_email', $startupProfile->founder_email ?? '') }}">
                            @error('founder_email')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 md:col-span-2">
                            <label class="form-label">Brief Background about founder *</label>
                            <textarea name="founder_background" class="form-control" rows="3" required>{{ old('founder_background', $startupProfile->founder_background ?? '') }}</textarea>
                            @error('founder_background')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
            </div>
        </div>

        <!-- Co-Founder Details -->
        <div class="profile-form-card">
            <div class="section-header">
                <span class="section-num">2</span>
                <h5>Co-Founder Details (If Applicable)</h5>
            </div>
            <div class="section-body">
                <div id="cofounders-container">
                    @if(isset($startupProfile->co_founders) && !empty($startupProfile->co_founders))
                        @foreach($startupProfile->co_founders as $index => $cofounder)
                            <div class="cofounder-block">
                                <div class="cofounder-block-header">
                                    <span class="cofounder-block-title">Co-Founder</span>
                                    <button type="button" class="btn btn-sm btn-remove-cofounder" title="Remove this co-founder">
                                        <i class="fas fa-trash-alt"></i> Remove
                                    </button>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="mb-3">
                                        <label class="form-label">Name of Co-Founder</label>
                                        <input type="text" name="co_founders[{{ $index }}][name]" class="form-control" value="{{ $cofounder['name'] ?? '' }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Co-Founder Gender</label>
                                        <select name="co_founders[{{ $index }}][gender]" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Male" {{ ($cofounder['gender'] ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ ($cofounder['gender'] ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                                            <option value="Other" {{ ($cofounder['gender'] ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Co-Founder Email Address</label>
                                        <input type="email" name="co_founders[{{ $index }}][email]" class="form-control" value="{{ $cofounder['email'] ?? '' }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Co-Founder Contact Number</label>
                                        <input type="text" name="co_founders[{{ $index }}][contact]" class="form-control" value="{{ $cofounder['contact'] ?? '' }}" maxlength="10" inputmode="numeric" pattern="[0-9]{1,10}" title="Max 10 digits">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Co-founder Role</label>
                                        <input type="text" name="co_founders[{{ $index }}][role]" class="form-control" value="{{ $cofounder['role'] ?? '' }}">
                                    </div>
                                    <div class="mb-3 md:col-span-2">
                                        <label class="form-label">Brief Background about Co-founder</label>
                                        <textarea name="co_founders[{{ $index }}][background]" class="form-control" rows="3">{{ $cofounder['background'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <button type="button" class="btn btn-outline-primary" id="btn-add-cofounder">
                    <i class="fas fa-plus me-2"></i>Add Co-Founder
                </button>
                <template id="cofounder-template">
                    <div class="cofounder-block">
                        <div class="cofounder-block-header">
                            <span class="cofounder-block-title">Co-Founder</span>
                            <button type="button" class="btn btn-sm btn-remove-cofounder" title="Remove this co-founder">
                                <i class="fas fa-trash-alt"></i> Remove
                            </button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-3">
                                <label class="form-label">Name of Co-Founder</label>
                                <input type="text" name="co_founders[__COFOUNDER_INDEX__][name]" class="form-control" value="">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Co-Founder Gender</label>
                                <select name="co_founders[__COFOUNDER_INDEX__][gender]" class="form-select">
                                    <option value="">Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Co-Founder Email Address</label>
                                <input type="email" name="co_founders[__COFOUNDER_INDEX__][email]" class="form-control" value="">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Co-Founder Contact Number</label>
                                <input type="text" name="co_founders[__COFOUNDER_INDEX__][contact]" class="form-control" value="" maxlength="10" inputmode="numeric" pattern="[0-9]{1,10}" title="Max 10 digits">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Co-founder Role</label>
                                <input type="text" name="co_founders[__COFOUNDER_INDEX__][role]" class="form-control" value="">
                            </div>
                            <div class="mb-3 md:col-span-2">
                                <label class="form-label">Brief Background about Co-founder</label>
                                <textarea name="co_founders[__COFOUNDER_INDEX__][background]" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Startup Details -->
        <div class="profile-form-card">
            <div class="section-header">
                <span class="section-num">3</span>
                <h5>Startup Details</h5>
            </div>
            <div class="section-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-3">
                            <label class="form-label">Name of the Company *</label>
                            <input type="text" name="company_name" class="form-control" required value="{{ old('company_name', $startupProfile->company_name ?? '') }}">
                            @error('company_name')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stage of Startup *</label>
                            <select name="startup_stage" class="form-select" required>
                                <option value="">Select</option>
                                <option value="Ideation: You have just an idea" {{ old('startup_stage', $startupProfile->startup_stage ?? '') == 'Ideation: You have just an idea' ? 'selected' : '' }}>Ideation: You have just an idea</option>
                                <option value="Proof of Concept (PoC): You have worked towards the idea to create a PoC." {{ old('startup_stage', $startupProfile->startup_stage ?? '') == 'Proof of Concept (PoC): You have worked towards the idea to create a PoC.' ? 'selected' : '' }}>Proof of Concept (PoC): You have worked towards the idea to create a PoC.</option>
                                <option value="Prototype/Minimum Viable Product (MVP): You have created a prototype/MVP and ready for pilot runs." {{ old('startup_stage', $startupProfile->startup_stage ?? '') == 'Prototype/Minimum Viable Product (MVP): You have created a prototype/MVP and ready for pilot runs.' ? 'selected' : '' }}>Prototype/Minimum Viable Product (MVP): You have created a prototype/MVP and ready for pilot runs.</option>
                                <option value="Early Revenue: You have just entered the market and generating business." {{ old('startup_stage', $startupProfile->startup_stage ?? '') == 'Early Revenue: You have just entered the market and generating business.' ? 'selected' : '' }}>Early Revenue: You have just entered the market and generating business.</option>
                                <option value="Growth/Scaling: You are already in the market since a while and now scaling rapidly." {{ old('startup_stage', $startupProfile->startup_stage ?? '') == 'Growth/Scaling: You are already in the market since a while and now scaling rapidly.' ? 'selected' : '' }}>Growth/Scaling: You are already in the market since a while and now scaling rapidly.</option>
                            </select>
                            @error('startup_stage')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">State *</label>
                            <input type="text" name="state" class="form-control"  required value="{{ old('state', $startupProfile->state ?? '') }}">
                            @error('state')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">City of Operation *</label>
                            <input type="text" name="city" class="form-control" required value="{{ old('city', $startupProfile->city ?? '') }}">
                            @error('city')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Size of Team (In Numbers) *</label>
                            <input type="number" name="team_size" class="form-control"  min="1" required value="{{ old('team_size', $startupProfile->team_size ?? '') }}">
                            @error('team_size')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Focus Areas/Sectors *</label>
                            <select name="focus_areas" class="form-select" required onchange="toggleOtherDomain()">
                                <option value="">Select</option>
                                @php $selectedFocus = old('focus_areas', $startupProfile->focus_areas ?? ''); @endphp
                                <option value="Sector Agnostic" {{ $selectedFocus == 'Sector Agnostic' ? 'selected' : '' }}>Sector Agnostic</option>
                                <option value="Adtech / Advertisement" {{ $selectedFocus == 'Adtech / Advertisement' ? 'selected' : '' }}>Adtech / Advertisement</option>
                                <option value="Aerospace & Aviation" {{ $selectedFocus == 'Aerospace & Aviation' ? 'selected' : '' }}>Aerospace & Aviation</option>
                                <option value="Agriculture / Agritech" {{ $selectedFocus == 'Agriculture / Agritech' ? 'selected' : '' }}>Agriculture / Agritech</option>
                                <option value="AI, ML" {{ $selectedFocus == 'AI, ML' ? 'selected' : '' }}>AI, ML</option>
                                <option value="AR, VR, XR, MR" {{ $selectedFocus == 'AR, VR, XR, MR' ? 'selected' : '' }}>AR, VR, XR, MR</option>
                                <option value="Architecture" {{ $selectedFocus == 'Architecture' ? 'selected' : '' }}>Architecture</option>
                                <option value="Automobiles" {{ $selectedFocus == 'Automobiles' ? 'selected' : '' }}>Automobiles</option>
                                <option value="Big Data" {{ $selectedFocus == 'Big Data' ? 'selected' : '' }}>Big Data</option>
                                <option value="Bioscience, Biotech" {{ $selectedFocus == 'Bioscience, Biotech' ? 'selected' : '' }}>Bioscience, Biotech</option>
                                <option value="Environment / Cleantech / Waste Management" {{ $selectedFocus == 'Environment / Cleantech / Waste Management' ? 'selected' : '' }}>Environment / Cleantech / Waste Management</option>
                                <option value="Cybersecurity" {{ $selectedFocus == 'Cybersecurity' ? 'selected' : '' }}>Cybersecurity</option>
                                <option value="Defence" {{ $selectedFocus == 'Defence' ? 'selected' : '' }}>Defence</option>
                                <option value="Design, Arts" {{ $selectedFocus == 'Design, Arts' ? 'selected' : '' }}>Design, Arts</option>
                                <option value="Disaster Management, Fire Safety" {{ $selectedFocus == 'Disaster Management, Fire Safety' ? 'selected' : '' }}>Disaster Management, Fire Safety</option>
                                <option value="E-commerce" {{ $selectedFocus == 'E-commerce' ? 'selected' : '' }}>E-commerce</option>
                                <option value="Education/ Edtech" {{ $selectedFocus == 'Education/ Edtech' ? 'selected' : '' }}>Education/ Edtech</option>
                                <option value="Clean Energy / Renewable Energy" {{ $selectedFocus == 'Clean Energy / Renewable Energy' ? 'selected' : '' }}>Clean Energy / Renewable Energy</option>
                                <option value="Entertainment" {{ $selectedFocus == 'Entertainment' ? 'selected' : '' }}>Entertainment</option>
                                <option value="Fashion" {{ $selectedFocus == 'Fashion' ? 'selected' : '' }}>Fashion</option>
                                <option value="Finance / Fintech / Banking" {{ $selectedFocus == 'Finance / Fintech / Banking' ? 'selected' : '' }}>Finance / Fintech / Banking</option>
                                <option value="FMCG" {{ $selectedFocus == 'FMCG' ? 'selected' : '' }}>FMCG</option>
                                <option value="Gaming" {{ $selectedFocus == 'Gaming' ? 'selected' : '' }}>Gaming</option>
                                <option value="Healthcare / Healthtech" {{ $selectedFocus == 'Healthcare / Healthtech' ? 'selected' : '' }}>Healthcare / Healthtech</option>
                                <option value="Human Resources / HRtech" {{ $selectedFocus == 'Human Resources / HRtech' ? 'selected' : '' }}>Human Resources / HRtech</option>
                                <option value="Information Technology" {{ $selectedFocus == 'Information Technology' ? 'selected' : '' }}>Information Technology</option>
                                <option value="Legal" {{ $selectedFocus == 'Legal' ? 'selected' : '' }}>Legal</option>
                                <option value="Logistics / Supply Chain" {{ $selectedFocus == 'Logistics / Supply Chain' ? 'selected' : '' }}>Logistics / Supply Chain</option>
                                <option value="Media & Communication" {{ $selectedFocus == 'Media & Communication' ? 'selected' : '' }}>Media & Communication</option>
                                <option value="Pharmaceuticals" {{ $selectedFocus == 'Pharmaceuticals' ? 'selected' : '' }}>Pharmaceuticals</option>
                                <option value="Real Estate & Construction" {{ $selectedFocus == 'Real Estate & Construction' ? 'selected' : '' }}>Real Estate & Construction</option>
                                <option value="Social" {{ $selectedFocus == 'Social' ? 'selected' : '' }}>Social</option>
                                <option value="Textiles" {{ $selectedFocus == 'Textiles' ? 'selected' : '' }}>Textiles</option>
                                <option value="Toy & Allied sectors" {{ $selectedFocus == 'Toy & Allied sectors' ? 'selected' : '' }}>Toy & Allied sectors</option>
                                <option value="Travel & Hospitality" {{ $selectedFocus == 'Travel & Hospitality' ? 'selected' : '' }}>Travel & Hospitality</option>
                                <option value="Others" {{ $selectedFocus == 'Others' ? 'selected' : '' }}>Others</option>
                            </select>
                            
                            <div id="otherDomainField" style="{{ $selectedFocus == 'Others' ? 'display: block;' : 'display: none;' }}">
                                <label for="otherDomain">Please specify Focus Areas/Sectors *</label>
                                <input type="text" id="otherDomain" name="other_focus_areas" class="form-control" maxlength="25" value="{{ old('other_focus_areas', '') }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Describe your Product/Service (Max 250 words) *</label>
                            <textarea name="product_description" class="form-control" rows="4" maxlength="250" required>{{ old('product_description', $startupProfile->product_description ?? '') }}</textarea>
                            <span class="char-count">/250 characters</span>
                            @error('product_description')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">What problem does your solution address? *</label>
                            <textarea name="problem_addressed" class="form-control" rows="4" required>{{ old('problem_addressed', $startupProfile->problem_addressed ?? '') }}</textarea>
                            @error('problem_addressed')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">What is unique about your idea? *</label>
                            <textarea name="unique_idea" class="form-control" rows="3" required>{{ old('unique_idea', $startupProfile->unique_idea ?? '') }}</textarea>
                            @error('unique_idea')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Key Intellectual Property (Patents, Trademarks, etc.) *</label>
                            <textarea name="key_ip" class="form-control" rows="3" required>{{ old('key_ip', $startupProfile->key_ip ?? '') }}</textarea>
                            @error('key_ip')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Revenue (INR) (as of last FY): *</label>
                            <input type="number" name="revenue_last_fy" class="form-control" min="0" step="0.01" required value="{{ old('revenue_last_fy', $startupProfile->revenue_last_fy ?? '') }}">
                            @error('revenue_last_fy')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Total Revenue till date (INR): *</label>
                            <input type="number" name="total_revenue" class="form-control"min="0" step="0.01" required value="{{ old('total_revenue', $startupProfile->total_revenue ?? '') }}">
                            @error('total_revenue')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Market Size/Target Market: *</label>
                            <textarea name="market_size" class="form-control" rows="3" required>{{ old('market_size', $startupProfile->market_size ?? '') }}</textarea>
                            @error('market_size')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Who are your competitors? *</label>
                            <textarea name="competitors" class="form-control" rows="3" required>{{ old('competitors', $startupProfile->competitors ?? '') }}</textarea>
                            @error('competitors')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Business Model: *</label>
                            <textarea name="business_model" class="form-control" rows="3" required>{{ old('business_model', $startupProfile->business_model ?? '') }}</textarea>
                            @error('business_model')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date of Incorporation/Registration *</label>
                            <input type="date" name="incorporation_date" class="form-control" required value="{{ old('incorporation_date', $startupProfile->incorporation_date ? $startupProfile->incorporation_date->format('Y-m-d') : '') }}">
                            @error('incorporation_date')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">DIPP startup certificate No: *</label>
                            <input type="text" name="dipp_number" class="form-control" required value="{{ old('dipp_number', $startupProfile->dipp_number ?? '') }}">
                            @error('dipp_number')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Your Startup Incubated at?</label>
                            <input type="text" name="incubated_at" class="form-control" value="{{ old('incubated_at', $startupProfile->incubated_at ?? '') }}">
                            @error('incubated_at')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name of Government Grant Received (if any)</label>
                            <input type="text" name="govt_grant_name" class="form-control" value="{{ old('govt_grant_name', $startupProfile->govt_grant_name ?? '') }}">
                            @error('govt_grant_name')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Amount of Government Grant Received (if any)</label>
                            <input type="number" name="govt_grant_amount" class="form-control" min="0" step="0.01" value="{{ old('govt_grant_amount', $startupProfile->govt_grant_amount ?? '') }}">
                            @error('govt_grant_amount')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
            </div>
        </div>

        <!-- Investment Details -->
        <div class="profile-form-card">
            <div class="section-header">
                <span class="section-num">4</span>
                <h5>Investment & Fundraising Details</h5>
            </div>
            <div class="section-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-3">
                            <label class="form-label">How much fund you have already raised?</label>
                            <input type="number" name="fund_raised" class="form-control"  min="0" step="0.01" value="{{ old('fund_raised', $startupProfile->fund_raised ?? '') }}">
                            @error('fund_raised')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Type of fund raised:</label>
                            <select name="fund_type" class="form-select">
                                <option value="">Select</option>
                                <option value="Seed" {{ old('fund_type', $startupProfile->fund_type ?? '') == 'Seed' ? 'selected' : '' }}>Seed</option>
                                <option value="Series A" {{ old('fund_type', $startupProfile->fund_type ?? '') == 'Series A' ? 'selected' : '' }}>Series A</option>
                                <option value="Series B" {{ old('fund_type', $startupProfile->fund_type ?? '') == 'Series B' ? 'selected' : '' }}>Series B</option>
                                <option value="Angel" {{ old('fund_type', $startupProfile->fund_type ?? '') == 'Angel' ? 'selected' : '' }}>Angel</option>
                                <option value="Venture Capital" {{ old('fund_type', $startupProfile->fund_type ?? '') == 'Venture Capital' ? 'selected' : '' }}>Venture Capital</option>
                                <option value="Government Grant" {{ old('fund_type', $startupProfile->fund_type ?? '') == 'Government Grant' ? 'selected' : '' }}>Government Grant</option>
                            </select>
                            @error('fund_type')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">How much capital do you seek to raise? (INR) *</label>
                            <input type="number" name="capital_seeking" class="form-control" min="0" step="0.01" required value="{{ old('capital_seeking', $startupProfile->capital_seeking ?? '') }}">
                            @error('capital_seeking')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fund Utilization Plan (PDF Upload) *</label>
                            <input type="file" name="fund_utilization_pdf" class="form-control" accept=".pdf">
                            @error('fund_utilization_pdf')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                            @if(!empty(trim($startupProfile->fund_utilization_pdf ?? '')))
                            <div class="current-file">
                                <span class="file-hint"><i class="fas fa-file-pdf text-success me-1"></i> Current: {{ basename($startupProfile->fund_utilization_pdf) }}</span>
                                <a href="{{ asset('storage/'.$startupProfile->fund_utilization_pdf) }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-success"><i class="fas fa-external-link-alt me-1"></i>View</a>
                            </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Attach your Pitch Deck (PDF Upload) *</label>
                            <input type="file" name="pitch_deck_pdf" class="form-control" accept=".pdf">
                            @error('pitch_deck_pdf')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                            @if(!empty(trim($startupProfile->pitch_deck_pdf ?? '')))
                            <div class="current-file">
                                <span class="file-hint"><i class="fas fa-file-pdf text-success me-1"></i> Current: {{ basename($startupProfile->pitch_deck_pdf) }}</span>
                                <a href="{{ asset('storage/'.$startupProfile->pitch_deck_pdf) }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-success"><i class="fas fa-external-link-alt me-1"></i>View</a>
                            </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Incorporation Certificate (PDF Upload) *</label>
                            <input type="file" name="incorporation_certificate_pdf" class="form-control" accept=".pdf">
                            @error('incorporation_certificate_pdf')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                            @if(!empty(trim($startupProfile->incorporation_certificate_pdf ?? '')))
                            <div class="current-file">
                                <span class="file-hint"><i class="fas fa-file-pdf text-success me-1"></i> Current: {{ basename($startupProfile->incorporation_certificate_pdf) }}</span>
                                <a href="{{ asset('storage/'.$startupProfile->incorporation_certificate_pdf) }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-success"><i class="fas fa-external-link-alt me-1"></i>View</a>
                            </div>
                            @endif
                        </div>
                    </div>
            </div>
        </div>

        <!-- Social Media Links -->
        <div class="profile-form-card">
            <div class="section-header">
                <span class="section-num">5</span>
                <h5>Social Media & Website Links (optional)</h5>
            </div>
            <div class="section-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-3">
                            <label class="form-label">Website URL (if any)</label>
                            <input type="url" name="website" class="form-control" value="{{ old('website', $startupProfile->website ?? '') }}">
                            @error('website')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">LinkedIn Profile of Organization (if any)</label>
                            <input type="url" name="linkedin" class="form-control" value="{{ old('linkedin', $startupProfile->linkedin ?? '') }}">
                            @error('linkedin')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Instagram Profile of Organization (if any)</label>
                            <input type="url" name="instagram" class="form-control" value="{{ old('instagram', $startupProfile->instagram ?? '') }}">
                            @error('instagram')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Facebook Profile of Organization (if any)</label>
                            <input type="url" name="facebook" class="form-control" value="{{ old('facebook', $startupProfile->facebook ?? '') }}">
                            @error('facebook')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Twitter Profile of Organization (if any)</label>
                            <input type="url" name="twitter" class="form-control" value="{{ old('twitter', $startupProfile->twitter ?? '') }}">
                            @error('twitter')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
            </div>
        </div>


        <div class="profile-edit-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-2"></i>Save Profile
            </button>
            <a href="{{ route('dashboard.startup.index') }}" class="btn btn-secondary">
                <i class="fas fa-times me-2"></i>Cancel
            </a>
        </div>
    </form>
</div>

<script>
function toggleOtherDomain() {
    const selectElement = document.querySelector('select[name="focus_areas"]');
    const otherField = document.getElementById('otherDomainField');
    
    if (selectElement.value === 'Others') {
        otherField.style.display = 'block';
        document.getElementById('otherDomain').required = true;
    } else {
        otherField.style.display = 'none';
        document.getElementById('otherDomain').required = false;
        document.getElementById('otherDomain').value = '';
    }
}

// Show other field on page load if "Others" is selected
document.addEventListener('DOMContentLoaded', function() {
    toggleOtherDomain();

    // Add Co-Founder: clone template, set correct index in names, append to container
    document.getElementById('btn-add-cofounder').addEventListener('click', function() {
        var container = document.getElementById('cofounders-container');
        var index = container.querySelectorAll('.cofounder-block').length;
        var t = document.getElementById('cofounder-template');
        var clone = t.content.cloneNode(true);
        clone.querySelectorAll('input, select, textarea').forEach(function(el) {
            if (el.name && el.name.indexOf('__COFOUNDER_INDEX__') !== -1)
                el.name = el.name.replace('__COFOUNDER_INDEX__', index);
        });
        container.appendChild(clone);
    });

    // Remove Co-Founder: delegate click on container
    document.getElementById('cofounders-container').addEventListener('click', function(e) {
        var btn = e.target.closest('.btn-remove-cofounder');
        if (btn) {
            var block = btn.closest('.cofounder-block');
            if (block) block.remove();
        }
    });
});
</script>
@endsection