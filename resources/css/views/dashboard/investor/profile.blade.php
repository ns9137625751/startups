@extends('dashboard.layout')
@section('title', 'Investor Profile')

@section('dashboard_content')
<style>
/* ===== Page Layout ===== */
.profile-edit-page {
    max-width: 100%;
    margin: 0;
    width: 100%;
}

/* ===== Header ===== */
.profile-edit-header {
    text-align: center;
    margin-bottom: 2rem;
    padding: 1.8rem;
    background: linear-gradient(135deg, #1F3C88 0%, #2d4a9e 100%);
    border-radius: 16px;
    color: #fff;
    box-shadow: 0 10px 30px rgba(31, 60, 136, 0.25);
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
    background: #1F3C88;
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
    border-color: #1F3C88;
    box-shadow: 0 0 0 3px rgba(31, 60, 136, 0.12);
    outline: none;
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
    background: #1F3C88;
    border-color: #1F3C88;
    box-shadow: 0 4px 12px rgba(31, 60, 136, 0.3);
}

.profile-edit-actions .btn-primary:hover {
    box-shadow: 0 6px 16px rgba(31, 60, 136, 0.35);
}

/* Checkbox styling */
.sector-checkbox {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.sector-checkbox:hover {
    background: #f8fafc;
    border-color: #1F3C88;
}

.sector-checkbox input[type="checkbox"] {
    width: 16px;
    height: 16px;
    accent-color: #1F3C88;
}

.sector-checkbox label {
    font-size: 0.85rem;
    font-weight: 500;
    color: #334155;
    cursor: pointer;
    margin: 0;
}
</style>

<div class="profile-edit-page">
    <div class="profile-edit-header">
        <h1><i class="fas fa-user-tie"></i> Investor Profile</h1>
        <p class="subtitle mb-0">Complete your investor profile to connect with startups</p>
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

    <form method="POST" action="{{ route('dashboard.investor.profile.store') }}" enctype="multipart/form-data" class="profile-edit-form">
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

        <!-- Fund Details -->
        <div class="profile-form-card">
            <div class="section-header">
                <span class="section-num">1</span>
                <h5>Fund Details</h5>
            </div>
            <div class="section-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-3">
                        <label class="form-label">Fund Name *</label>
                        <input type="text" name="fund_name" class="form-control" required value="{{ old('fund_name', $investorProfile->fund_name ?? '') }}">
                        @error('fund_name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fund Email *</label>
                        <input type="email" name="fund_email" class="form-control" required value="{{ old('fund_email', $investorProfile->fund_email ?? '') }}">
                        @error('fund_email')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fund Mobile Number *</label>
                        <input type="text" name="fund_mobile_number" class="form-control" maxlength="20" required value="{{ old('fund_mobile_number', $investorProfile->fund_mobile_number ?? '') }}">
                        @error('fund_mobile_number')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fund Logo</label>
                        <input type="file" name="logo" class="form-control" accept="image/*">
                        @error('logo')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                        @if(!empty(trim($investorProfile->logo ?? '')))
                        <div class="current-file">
                            <span class="file-hint"><i class="fas fa-file-image text-success me-1"></i> Current: {{ basename($investorProfile->logo) }}</span>
                            <a href="{{ asset('storage/'.$investorProfile->logo) }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-success"><i class="fas fa-external-link-alt me-1"></i>View</a>
                        </div>
                        @endif
                    </div>
                    <div class="mb-3 md:col-span-2">
                        <label class="form-label">Fund Brief *</label>
                        <textarea name="fund_brief" class="form-control" rows="4" required>{{ old('fund_brief', $investorProfile->fund_brief ?? '') }}</textarea>
                        @error('fund_brief')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Partner Details -->
        <div class="profile-form-card">
            <div class="section-header">
                <span class="section-num">2</span>
                <h5>Partner Details</h5>
            </div>
            <div class="section-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-3">
                        <label class="form-label">Partner Name *</label>
                        <input type="text" name="partner_name" class="form-control" required value="{{ old('partner_name', $investorProfile->partner_name ?? '') }}">
                        @error('partner_name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Partner Email *</label>
                        <input type="email" name="partner_email" class="form-control" required value="{{ old('partner_email', $investorProfile->partner_email ?? '') }}">
                        @error('partner_email')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Partner Mobile Number *</label>
                        <input type="text" name="partner_mobile_number" class="form-control" maxlength="20" required value="{{ old('partner_mobile_number', $investorProfile->partner_mobile_number ?? '') }}">
                        @error('partner_mobile_number')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Partner Image</label>
                        <input type="file" name="founder_img" class="form-control" accept="image/*">
                        @error('founder_img')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                        @if(!empty(trim($investorProfile->founder_img ?? '')))
                        <div class="current-file">
                            <span class="file-hint"><i class="fas fa-file-image text-success me-1"></i> Current: {{ basename($investorProfile->founder_img) }}</span>
                            <a href="{{ asset('storage/'.$investorProfile->founder_img) }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-success"><i class="fas fa-external-link-alt me-1"></i>View</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Investment Details -->
        <div class="profile-form-card">
            <div class="section-header">
                <span class="section-num">3</span>
                <h5>Investment Details</h5>
            </div>
            <div class="section-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-3">
                        <label class="form-label">Ticket Size (INR) *</label>
                        <input type="number" name="ticket_size" class="form-control" min="0" step="0.01" required value="{{ old('ticket_size', $investorProfile->ticket_size ?? '') }}">
                        @error('ticket_size')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">City *</label>
                        <input type="text" name="city" class="form-control" required value="{{ old('city', $investorProfile->city ?? '') }}">
                        @error('city')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">State *</label>
                        <input type="text" name="state" class="form-control" required value="{{ old('state', $investorProfile->state ?? '') }}">
                        @error('state')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Website</label>
                        <input type="url" name="website" class="form-control" value="{{ old('website', $investorProfile->website ?? '') }}">
                        @error('website')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 md:col-span-2">
                        <label class="form-label">Portfolio Companies</label>
                        <textarea name="portfolio_companies" class="form-control" rows="3" placeholder="List your portfolio companies...">{{ old('portfolio_companies', $investorProfile->portfolio_companies ?? '') }}</textarea>
                        @error('portfolio_companies')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Investment Sectors -->
        <div class="profile-form-card">
            <div class="section-header">
                <span class="section-num">4</span>
                <h5>Investment Sectors *</h5>
            </div>
            <div class="section-body">
                <p class="text-sm text-gray-600 mb-4">Select the sectors you are interested in investing:</p>
                @php
                    $selectedSectors = old('investment_sectors', $investorProfile->investment_sectors ?? []);
                @endphp
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    @foreach($domains as $domain)
                        <div class="sector-checkbox">
                            <input type="checkbox" 
                                   name="investment_sectors[]" 
                                   value="{{ $domain->id }}" 
                                   id="sector_{{ $domain->id }}"
                                   {{ in_array($domain->id, $selectedSectors) ? 'checked' : '' }}>
                            <label for="sector_{{ $domain->id }}">{{ $domain->name }}</label>
                        </div>
                    @endforeach
                </div>
                @error('investment_sectors')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="profile-edit-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-2"></i>Save Profile
            </button>
            <a href="{{ route('dashboard.investor.index') }}" class="btn btn-secondary">
                <i class="fas fa-times me-2"></i>Cancel
            </a>
        </div>
    </form>
</div>

@endsection