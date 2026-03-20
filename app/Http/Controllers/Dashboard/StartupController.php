<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\InvestorProfile;
use App\Models\User;
use Illuminate\Http\Request;

class StartupController extends Controller
{
    public function index()
    {
        return view('dashboard.startup.index');
    }

    public function browseInvestors(Request $request)
    {
        $q         = $request->input('q', '');
        $sector    = $request->input('sector', '');
        $investors = InvestorProfile::with('user')
            ->where('can_approved', 1)
            ->when($q, fn($query) => $query->where(function ($sub) use ($q) {
                $sub->where('fund_name',           'like', "%{$q}%")
                    ->orWhere('partner_name',       'like', "%{$q}%")
                    ->orWhere('city',               'like', "%{$q}%")
                    ->orWhere('state',              'like', "%{$q}%")
                    ->orWhere('portfolio_companies','like', "%{$q}%");
            }))
            ->when($sector, function ($query) use ($sector) {
                $query->whereJsonContains('investment_sectors', (int) $sector);
            })
            ->latest()->paginate(9)->withQueryString();
        $domains = Domain::orderBy('name')->get();
        return view('dashboard.startup.browse-investors', compact('investors', 'q', 'sector', 'domains'));
    }

    public function browseIncubators(Request $request)
    {
        $q = $request->input('q', '');
        $incubators = User::where('role', 'incubator')
            ->where('is_verified', true)
            ->when($q, fn($query) => $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")->orWhere('email', 'like', "%{$q}%");
            }))
            ->latest()->paginate(9)->withQueryString();
        return view('dashboard.startup.browse-incubators', compact('incubators', 'q'));
    }

    public function showInvestor(string $hash)
    {
        $id = decrypt($hash);
        $investor = InvestorProfile::findOrFail($id);
        abort_unless($investor->can_approved, 404);
        $investor->load('user');
        $domainMap = Domain::pluck('name', 'id');
        return view('dashboard.startup.show-investor', compact('investor', 'domainMap'));
    }
}
