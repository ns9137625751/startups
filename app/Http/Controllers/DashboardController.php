<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RoleSetting;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function superAdmin()
    {
        $roles       = User::roles();
        $roleCounts  = User::selectRaw('role, count(*) as total')->groupBy('role')->pluck('total', 'role');
        $totalUsers  = User::count();
        $verified    = User::where('is_verified', true)->count();
        return view('dashboard.super-admin', compact('roles', 'roleCounts', 'totalUsers', 'verified'));
    }

    public function rolesPage()
    {
        $roles       = User::roles();
        $roleCounts  = User::selectRaw('role, count(*) as total')->groupBy('role')->pluck('total', 'role');
        $totalUsers  = User::count();
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

        return view('dashboard.roles', compact('roleDetails', 'totalUsers'));
    }

    public function toggleRole(Request $request)
    {
        $request->validate(['role' => 'required|string']);
        $role = $request->input('role');

        // Protect super_admin from being deactivated
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

        // Resolve a human-readable title for the filter
        $titles = [
            'all'        => 'All Users',
            'verified'   => 'Verified Users',
            'unverified' => 'Unverified Users',
        ];
        if (str_starts_with($filter, 'role:')) {
            $roleKey = substr($filter, 5);
            $title   = ($roles[$roleKey] ?? ucfirst(str_replace('_', ' ', $roleKey))) . ' Users';
        } else {
            $title = $titles[$filter] ?? 'All Users';
        }

        return view('dashboard.users-table', compact('filter', 'title', 'roles'));
    }

    public function usersSearch(Request $request)
    {
        $q      = $request->input('q', '');
        $filter = $request->input('filter', 'all'); // all | verified | unverified | role:<key>

        $query = User::query();

        // Filter by card clicked
        if ($filter === 'verified') {
            $query->where('is_verified', true);
        } elseif ($filter === 'unverified') {
            $query->where('is_verified', false);
        } elseif (str_starts_with($filter, 'role:')) {
            $query->where('role', substr($filter, 5));
        }

        // Search by name or email
        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            });
        }

        $users = $query->latest()->get();

        $roleColors = [
            'super_admin'     => ['bg' => '#fff3e0', 'text' => '#FF8C42'],
            'startup'         => ['bg' => '#f0fdf4', 'text' => '#57BD68'],
            'investor'        => ['bg' => '#eff6ff', 'text' => '#1F3C88'],
            'mentor'          => ['bg' => '#fdf4ff', 'text' => '#9333ea'],
            'incubator'       => ['bg' => '#fff7ed', 'text' => '#ea580c'],
            'government_body' => ['bg' => '#f0f9ff', 'text' => '#0284c7'],
            'industry_expert' => ['bg' => '#fafafa', 'text' => '#374151'],
        ];

        $rows = $users->map(function ($u) use ($roleColors) {
            $rc = $roleColors[$u->role] ?? ['bg' => '#f3f4f6', 'text' => '#374151'];
            return [
                'id'         => $u->id,
                'name'       => $u->name,
                'email'      => $u->email,
                'role'       => str_replace('_', ' ', $u->role),
                'role_bg'    => $rc['bg'],
                'role_text'  => $rc['text'],
                'verified'   => $u->is_verified,
                'joined'     => $u->created_at->format('d M Y'),
            ];
        });

        return response()->json(['users' => $rows, 'total' => $rows->count()]);
    }

    public function startup()       { return view('dashboard.startup'); }

    public function browseInvestors(Request $request)
    {
        $q = $request->input('q', '');
        $investors = User::where('role', 'investor')
            ->where('is_verified', true)
            ->when($q, fn($query) => $query->where(function($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            }))
            ->latest()->paginate(9)->withQueryString();
        return view('dashboard.browse-investors', compact('investors', 'q'));
    }

    public function browseIncubators(Request $request)
    {
        $q = $request->input('q', '');
        $incubators = User::where('role', 'incubator')
            ->where('is_verified', true)
            ->when($q, fn($query) => $query->where(function($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            }))
            ->latest()->paginate(9)->withQueryString();
        return view('dashboard.browse-incubators', compact('incubators', 'q'));
    }
    public function investor()      { return view('dashboard.investor'); }
    public function mentor()        { return view('dashboard.mentor'); }
    public function incubator()     { return view('dashboard.incubator'); }
    public function government()    { return view('dashboard.government'); }
    public function industryExpert(){ return view('dashboard.industry-expert'); }
}
