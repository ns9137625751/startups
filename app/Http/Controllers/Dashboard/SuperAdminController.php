<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\InvestorProfilesExport;
use App\Exports\InvestorProfilesTemplateExport;
use App\Exports\StartupProfilesExport;
use App\Exports\StartupProfilesTemplateExport;
use App\Http\Controllers\Controller;
use App\Imports\InvestorProfilesImport;
use App\Imports\StartupProfilesImport;
use App\Models\Domain;
use App\Models\InvestorProfile;
use App\Models\RoleSetting;
use App\Models\StartupProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class SuperAdminController extends Controller
{
    public function index()
    {
        $roles            = User::roles();
        $roleCounts       = User::selectRaw('role, count(*) as total')->groupBy('role')->pluck('total', 'role');
        $totalUsers       = User::count();
        $verified         = User::where('is_verified', true)->count();
        $totalStartups    = StartupProfile::count();
        $pendingStartups  = StartupProfile::where('can_approved', 0)->count();
        $totalInvestors   = InvestorProfile::count();
        $pendingInvestors = InvestorProfile::where('can_approved', 0)->count();
        return view('dashboard.super-admin.index', compact(
            'roles', 'roleCounts', 'totalUsers', 'verified',
            'totalStartups', 'pendingStartups', 'totalInvestors', 'pendingInvestors'
        ));
    }

    // ── Startup Profiles ─────────────────────────────────────────────────────

    public function startupProfiles()
    {
        $domains = Domain::orderBy('name')->get();
        return view('dashboard.super-admin.startups', compact('domains'));
    }

    public function startupSearch(Request $request)
    {
        $search  = $request->input('q', '');
        $filter  = $request->input('filter', 'all');
        $domain  = $request->input('domain', '');
        $page    = max(1, (int) $request->input('page', 1));
        $perPage = 15;

        $query = StartupProfile::with('user')
            ->when($filter === 'pending',  fn($q) => $q->where('can_approved', 0))
            ->when($filter === 'approved', fn($q) => $q->where('can_approved', 1))
            ->when($filter === 'rejected', fn($q) => $q->where('can_approved', 2))
            ->when($domain, fn($q) => $q->where('focus_areas', 'like', "%{$domain}%"))
            ->when($search, fn($q) => $q->where(function ($sub) use ($search) {
                $sub->where('company_name',    'like', "%{$search}%")
                    ->orWhere('founder_name',   'like', "%{$search}%")
                    ->orWhere('founder_email',  'like', "%{$search}%")
                    ->orWhere('founder_contact','like', "%{$search}%")
                    ->orWhere('focus_areas',    'like', "%{$search}%")
                    ->orWhere('startup_stage',  'like', "%{$search}%");
            }))
            ->latest();

        $total    = $query->count();
        $profiles = $query->forPage($page, $perPage)->get();
        $lastPage = max(1, (int) ceil($total / $perPage));
        $csrf     = csrf_token();

        $rows = $profiles->map(function ($p, $i) use ($page, $perPage, $csrf) {
            $sr      = ($page - 1) * $perPage + $i + 1;
            $initial = strtoupper(substr($p->company_name, 0, 1));
            $badge   = $this->statusBadge($p->can_approved);

            $showUrl    = route('dashboard.super-admin.startups.show', $p);
            $editUrl    = route('dashboard.super-admin.startups.edit', $p);
            $deleteUrl  = route('dashboard.super-admin.startups.delete', $p);
            $approveUrl = route('dashboard.super-admin.startups.approve', $p);
            $approveBtn = $p->can_approved == 0 ? $this->approveBtn($approveUrl, $csrf) : '';

            return [
                'sr' => $sr, 'initial' => $initial,
                'company' => e($p->company_name), 'stage' => e($p->startup_stage),
                'founder' => e($p->founder_name),  'email' => e($p->founder_email),
                'contact' => e($p->founder_contact), 'domain' => e($p->focus_areas),
                'badge' => $badge, 'showUrl' => $showUrl, 'editUrl' => $editUrl,
                'deleteUrl' => $deleteUrl, 'approveBtn' => $approveBtn, 'csrf' => $csrf,
            ];
        });

        return response()->json(['rows' => $rows, 'total' => $total, 'page' => $page, 'lastPage' => $lastPage, 'perPage' => $perPage]);
    }

    public function showStartup(StartupProfile $startup)
    {
        $startup->load('user');
        return view('dashboard.super-admin.startup-show', compact('startup'));
    }

    public function editStartup(StartupProfile $startup)
    {
        $startup->load('user');
        return view('dashboard.super-admin.startup-edit', compact('startup'));
    }

    public function updateStartup(Request $request, StartupProfile $startup)
    {
        $validated = $request->validate([
            'company_name'        => 'required|string|max:255',
            'founder_name'        => 'required|string|max:255',
            'founder_email'       => 'required|email|max:255',
            'founder_contact'     => 'required|string|max:20',
            'founder_gender'      => 'required|in:Male,Female,Other',
            'founder_background'  => 'required|string',
            'startup_stage'       => 'required|in:Ideation,Validation,Early Stage,Growth,Scaling',
            'state'               => 'required|string|max:100',
            'city'                => 'required|string|max:100',
            'team_size'           => 'required|integer|min:1',
            'focus_areas'         => 'required|string|max:255',
            'product_description' => 'required|string',
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
            'fund_raised'         => 'nullable|numeric|min:0',
            'fund_type'           => 'nullable|in:Bootstrapped,Angel,Seed,Series A,Series B,Grant,Other',
            'capital_seeking'     => 'required|numeric|min:0',
            'website'             => 'nullable|url|max:255',
            'linkedin'            => 'nullable|url|max:255',
            'instagram'           => 'nullable|url|max:255',
            'facebook'            => 'nullable|url|max:255',
            'twitter'             => 'nullable|url|max:255',
            'can_approved'        => 'required|in:0,1,2',
        ]);

        foreach (['fund_utilization_pdf', 'pitch_deck_pdf', 'incorporation_certificate_pdf'] as $field) {
            if ($request->hasFile($field)) {
                if ($startup->$field) Storage::disk('public')->delete($startup->$field);
                $validated[$field] = $request->file($field)->store('startup-docs', 'public');
            }
        }

        $startup->update($validated);
        return redirect()->route('dashboard.super-admin.startups')->with('success', 'Startup profile updated successfully.');
    }

    public function deleteStartup(StartupProfile $startup)
    {
        foreach (['fund_utilization_pdf', 'pitch_deck_pdf', 'incorporation_certificate_pdf'] as $field) {
            if ($startup->$field) Storage::disk('public')->delete($startup->$field);
        }
        $startup->delete();
        return redirect()->route('dashboard.super-admin.startups')->with('success', 'Startup profile deleted successfully.');
    }

    public function approveStartup(Request $request, StartupProfile $startup)
    {
        $request->validate(['status' => 'required|in:0,1,2']);
        $startup->update(['can_approved' => $request->status]);
        $label = ['0' => 'Pending', '1' => 'Approved', '2' => 'Rejected'][$request->status];
        
        // If request came from the startups list page, redirect back with filter
        if ($request->has('filter')) {
            return redirect()->route('dashboard.super-admin.startups')
                ->with('success', "Startup marked as {$label}.")
                ->with('filter', $request->input('filter'));
        }
        
        return back()->with('success', "Startup marked as {$label}.");
    }

    public function exportStartups()
    {
        return Excel::download(new StartupProfilesExport, 'startup-profiles-' . date('Y-m-d') . '.xlsx');
    }

    public function exportStartupsTemplate()
    {
        return Excel::download(new StartupProfilesTemplateExport, 'startup-profiles-template.xlsx');
    }

    public function importStartups(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240', // 10MB max
        ]);

        try {
            Excel::import(new StartupProfilesImport, $request->file('file'));
            return redirect()->route('dashboard.super-admin.startups')
                ->with('success', 'Startup profiles imported successfully!');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.super-admin.startups')
                ->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    // ── Investor Profiles ─────────────────────────────────────────────────────

    public function investorProfiles()
    {
        $domains = Domain::orderBy('name')->get();
        return view('dashboard.super-admin.investors', compact('domains'));
    }

    public function investorSearch(Request $request)
    {
        $search  = $request->input('q', '');
        $filter  = $request->input('filter', 'all');
        $page    = max(1, (int) $request->input('page', 1));
        $perPage = 15;

        $domainId = $request->input('domain', '');

        $query = InvestorProfile::with('user')
            ->when($filter === 'pending',  fn($q) => $q->where('can_approved', 0))
            ->when($filter === 'approved', fn($q) => $q->where('can_approved', 1))
            ->when($filter === 'rejected', fn($q) => $q->where('can_approved', 2))
            ->when($domainId, fn($q) => $q->whereJsonContains('investment_sectors', (int) $domainId))
            ->when($search, fn($q) => $q->where(function ($sub) use ($search) {
                $sub->where('fund_name',           'like', "%{$search}%")
                    ->orWhere('fund_email',         'like', "%{$search}%")
                    ->orWhere('fund_mobile_number', 'like', "%{$search}%")
                    ->orWhere('partner_name',       'like', "%{$search}%")
                    ->orWhere('partner_email',      'like', "%{$search}%")
                    ->orWhere('city',               'like', "%{$search}%")
                    ->orWhere('state',              'like', "%{$search}%");
            }))
            ->latest();

        $total    = $query->count();
        $profiles = $query->forPage($page, $perPage)->get();
        $lastPage = max(1, (int) ceil($total / $perPage));
        $csrf     = csrf_token();

        $domainMap = Domain::pluck('name', 'id');

        $rows = $profiles->map(function ($p, $i) use ($page, $perPage, $csrf, $domainMap) {
            $sr      = ($page - 1) * $perPage + $i + 1;
            $initial = strtoupper(substr($p->fund_name, 0, 1));
            $badge   = $this->statusBadge($p->can_approved);

            $sectors = collect($p->investment_sectors ?? [])
                ->map(fn($id) => $domainMap[$id] ?? null)->filter()->implode(', ');

            $showUrl    = route('dashboard.super-admin.investors.show', $p);
            $editUrl    = route('dashboard.super-admin.investors.edit', $p);
            $deleteUrl  = route('dashboard.super-admin.investors.delete', $p);
            $approveUrl = route('dashboard.super-admin.investors.approve', $p);
            $approveBtn = $p->can_approved == 0 ? $this->approveBtn($approveUrl, $csrf) : '';

            return [
                'sr' => $sr, 'initial' => $initial,
                'fund_name'    => e($p->fund_name),
                'partner_name' => e($p->partner_name),
                'fund_email'   => e($p->fund_email),
                'fund_mobile'  => e($p->fund_mobile_number),
                'ticket_size'  => '₹' . number_format($p->ticket_size / 100000, 1) . 'L',
                'sectors'      => e($sectors ?: '—'),
                'badge' => $badge, 'showUrl' => $showUrl, 'editUrl' => $editUrl,
                'deleteUrl' => $deleteUrl, 'approveBtn' => $approveBtn, 'csrf' => $csrf,
            ];
        });

        return response()->json(['rows' => $rows, 'total' => $total, 'page' => $page, 'lastPage' => $lastPage, 'perPage' => $perPage]);
    }

    public function showInvestor(InvestorProfile $investor)
    {
        $investor->load('user');
        $domainMap = Domain::pluck('name', 'id');
        return view('dashboard.super-admin.investor-show', compact('investor', 'domainMap'));
    }

    public function editInvestor(InvestorProfile $investor)
    {
        $investor->load('user');
        $domains = Domain::orderBy('name')->get();
        return view('dashboard.super-admin.investor-edit', compact('investor', 'domains'));
    }

    public function updateInvestor(Request $request, InvestorProfile $investor)
    {
        $validated = $request->validate([
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
            'can_approved'           => 'required|in:0,1,2',
        ]);

        foreach (['logo', 'founder_img'] as $field) {
            if ($request->hasFile($field)) {
                if ($investor->$field) Storage::disk('public')->delete($investor->$field);
                $validated[$field] = $request->file($field)->store('investor-docs', 'public');
            }
        }

        $investor->update($validated);
        return redirect()->route('dashboard.super-admin.investors')->with('success', 'Investor profile updated successfully.');
    }

    public function deleteInvestor(InvestorProfile $investor)
    {
        foreach (['logo', 'founder_img'] as $field) {
            if ($investor->$field) Storage::disk('public')->delete($investor->$field);
        }
        $investor->delete();
        return redirect()->route('dashboard.super-admin.investors')->with('success', 'Investor profile deleted successfully.');
    }

    public function approveInvestor(Request $request, InvestorProfile $investor)
    {
        $request->validate(['status' => 'required|in:0,1,2']);
        $investor->update(['can_approved' => $request->status]);
        $label = ['0' => 'Pending', '1' => 'Approved', '2' => 'Rejected'][$request->status];
        return back()->with('success', "Investor marked as {$label}.");
    }

    public function exportInvestors()
    {
        return Excel::download(new InvestorProfilesExport, 'investor-profiles-' . date('Y-m-d') . '.xlsx');
    }

    public function exportInvestorsTemplate()
    {
        return Excel::download(new InvestorProfilesTemplateExport, 'investor-profiles-template.xlsx');
    }

    public function importInvestors(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240', // 10MB max
        ]);

        try {
            Excel::import(new InvestorProfilesImport, $request->file('file'));
            return redirect()->route('dashboard.super-admin.investors')
                ->with('success', 'Investor profiles imported successfully!');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.super-admin.investors')
                ->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    // ── Roles & Users ─────────────────────────────────────────────────────────

    public function rolesPage()
    {
        $roles        = User::roles();
        $roleCounts   = User::selectRaw('role, count(*) as total')->groupBy('role')->pluck('total', 'role');
        $totalUsers   = User::count();
        $roleSettings = RoleSetting::pluck('is_active', 'role');

        $roleDetails = [];
        foreach ($roles as $key => $label) {
            $count    = $roleCounts[$key] ?? 0;
            $verified = User::where('role', $key)->where('is_verified', true)->count();
            $latest   = User::where('role', $key)->latest()->first();
            $roleDetails[$key] = [
                'label'     => $label,
                'total'     => $count,
                'verified'  => $verified,
                'pending'   => $count - $verified,
                'latest'    => $latest,
                'percent'   => $totalUsers > 0 ? round(($count / $totalUsers) * 100) : 0,
                'is_active' => $roleSettings[$key] ?? true,
            ];
        }

        return view('dashboard.super-admin.roles', compact('roleDetails', 'totalUsers'));
    }

    public function toggleRole(Request $request)
    {
        $request->validate(['role' => 'required|string']);
        $role = $request->input('role');

        if ($role === 'super_admin') {
            return response()->json(['error' => 'Cannot deactivate super_admin role.'], 403);
        }

        $setting = RoleSetting::firstOrCreate(['role' => $role], ['is_active' => true]);
        $setting->is_active = !$setting->is_active;
        $setting->save();

        return response()->json(['role' => $role, 'is_active' => $setting->is_active]);
    }

    public function usersPage(Request $request)
    {
        $filter = $request->input('filter', 'all');
        $roles  = User::roles();

        $titles = ['all' => 'All Users', 'verified' => 'Verified Users', 'unverified' => 'Unverified Users'];
        if (str_starts_with($filter, 'role:')) {
            $roleKey = substr($filter, 5);
            $title   = ($roles[$roleKey] ?? ucfirst(str_replace('_', ' ', $roleKey))) . ' Users';
        } else {
            $title = $titles[$filter] ?? 'All Users';
        }

        return view('dashboard.super-admin.users-table', compact('filter', 'title', 'roles'));
    }

    public function usersSearch(Request $request)
    {
        $q      = $request->input('q', '');
        $filter = $request->input('filter', 'all');
        $query  = User::query();

        if ($filter === 'verified') {
            $query->where('is_verified', true);
        } elseif ($filter === 'unverified') {
            $query->where('is_verified', false);
        } elseif (str_starts_with($filter, 'role:')) {
            $query->where('role', substr($filter, 5));
        }

        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")->orWhere('email', 'like', "%{$q}%");
            });
        }

        $roleColors = [
            'super_admin'     => ['bg' => '#fff3e0', 'text' => '#FF8C42'],
            'startup'         => ['bg' => '#f0fdf4', 'text' => '#57BD68'],
            'investor'        => ['bg' => '#eff6ff', 'text' => '#1F3C88'],
            'mentor'          => ['bg' => '#fdf4ff', 'text' => '#9333ea'],
            'incubator'       => ['bg' => '#fff7ed', 'text' => '#ea580c'],
            'government_body' => ['bg' => '#f0f9ff', 'text' => '#0284c7'],
            'industry_expert' => ['bg' => '#fafafa', 'text' => '#374151'],
        ];

        $rows = $query->latest()->get()->map(function ($u) use ($roleColors) {
            $rc = $roleColors[$u->role] ?? ['bg' => '#f3f4f6', 'text' => '#374151'];
            return [
                'id'        => $u->id,
                'name'      => $u->name,
                'email'     => $u->email,
                'role'      => str_replace('_', ' ', $u->role),
                'role_bg'   => $rc['bg'],
                'role_text' => $rc['text'],
                'verified'  => $u->is_verified,
                'joined'    => $u->created_at->format('d M Y'),
            ];
        });

        return response()->json(['users' => $rows, 'total' => $rows->count()]);
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    private function statusBadge(int $status): string
    {
        return match($status) {
            1 => '<span class="px-2.5 py-1 rounded-full text-xs font-bold" style="background:#f0fdf4;color:#57BD68;">&#10003; Approved</span>',
            2 => '<span class="px-2.5 py-1 rounded-full text-xs font-bold" style="background:#fef2f2;color:#ef4444;">&#10007; Rejected</span>',
            default => '<span class="px-2.5 py-1 rounded-full text-xs font-bold" style="background:#fff7ed;color:#FF8C42;">&#9203; Pending</span>',
        };
    }

    private function approveBtn(string $url, string $csrf): string
    {
        return '<form method="POST" action="'.$url.'"><input type="hidden" name="_token" value="'.$csrf.'"><input type="hidden" name="status" value="1"><input type="hidden" name="filter" id="filter-input" value=""><button type="submit" class="px-2.5 py-1 rounded-lg text-xs font-bold" style="background:#dcfce7;color:#16a34a;border:none;cursor:pointer;" onmouseover="this.style.background=\'#16a34a\';this.style.color=\'#fff\'" onmouseout="this.style.background=\'#dcfce7\';this.style.color=\'#16a34a\'">&#10004; Approve</button></form>';
    }
}
