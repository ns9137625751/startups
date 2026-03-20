@extends('dashboard.layout')
@section('title', 'Roles Overview – Super Admin')

@section('dashboard_content')

<div class="mb-6 flex items-center gap-3">
    <a href="{{ route('dashboard.super-admin.index') }}"
       class="w-8 h-8 rounded-lg flex items-center justify-center border hover:bg-gray-50 transition-colors flex-shrink-0"
       style="border-color:#e5e7eb;">
        <svg class="w-4 h-4" style="color:#6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </a>
    <div>
        <h1 class="text-2xl font-extrabold" style="color:#0d1b2a;">Roles Management</h1>
        <p class="text-sm font-semibold mt-0.5" style="color:#4b5563;">
            {{ count($roleDetails) }} roles &nbsp;·&nbsp; {{ $totalUsers }} total users
        </p>
    </div>
</div>

<!-- Summary Cards -->
<div class="grid gap-4 mb-8" style="grid-template-columns: repeat(4, 1fr);">
    @php
    $summaryStats = [
        ['Total Roles',   count($roleDetails),                          '#57BD68','#f0fdf4'],
        ['Total Users',   $totalUsers,                                  '#1F3C88','#eff6ff'],
        ['Active Roles',  collect($roleDetails)->where('is_active',true)->count(),  '#57BD68','#f0fdf4'],
        ['Inactive Roles',collect($roleDetails)->where('is_active',false)->count(), '#ef4444','#fef2f2'],
    ];
    @endphp
    @foreach($summaryStats as [$label, $val, $color, $bg])
    <div class="stat-card" style="border-left:3px solid {{ $color }};">
        <p class="text-xs font-bold mb-1" style="color:#4b5563;">{{ $label }}</p>
        <p class="text-3xl font-extrabold" style="color:{{ $color }};">{{ $val }}</p>
    </div>
    @endforeach
</div>

<!-- Toast notification -->
<div id="toast" style="display:none; position:fixed; top:20px; right:20px; z-index:9999;
     padding:12px 20px; border-radius:10px; font-size:13px; font-weight:700;
     box-shadow:0 4px 20px rgba(0,0,0,0.15); transition:all .3s;"></div>

<!-- Roles Table -->
<div class="bg-white border rounded-xl overflow-hidden" style="border-color:#e5e7eb;">

    <div class="px-5 py-4 border-b flex items-center justify-between" style="border-color:#f3f4f6;">
        <div>
            <h2 class="font-extrabold text-sm" style="color:#0d1b2a;">All Roles</h2>
            <p class="text-xs font-semibold mt-0.5" style="color:#6b7280;">Toggle to activate or deactivate a role on the registration page</p>
        </div>
        <div class="flex items-center gap-2 text-xs font-bold" style="color:#6b7280;">
            <span class="w-3 h-3 rounded-full inline-block" style="background:#57BD68;"></span> Active
            <span class="w-3 h-3 rounded-full inline-block ml-2" style="background:#e5e7eb;"></span> Inactive
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead style="background:#f9fafb;">
                <tr>
                    <th class="text-left py-3 px-5 text-xs font-extrabold" style="color:#0d1b2a;">#</th>
                    <th class="text-left py-3 px-5 text-xs font-extrabold" style="color:#0d1b2a;">Role</th>
                    <th class="text-left py-3 px-5 text-xs font-extrabold" style="color:#0d1b2a;">Total Users</th>
                    <th class="text-left py-3 px-5 text-xs font-extrabold" style="color:#0d1b2a;">Verified</th>
                    <th class="text-left py-3 px-5 text-xs font-extrabold" style="color:#0d1b2a;">Pending</th>
                    <th class="text-left py-3 px-5 text-xs font-extrabold" style="color:#0d1b2a;">Share</th>
                    <th class="text-left py-3 px-5 text-xs font-extrabold" style="color:#0d1b2a;">Latest Member</th>
                    <th class="text-left py-3 px-5 text-xs font-extrabold" style="color:#0d1b2a;">Status</th>
                    <th class="text-left py-3 px-5 text-xs font-extrabold" style="color:#0d1b2a;">Users</th>
                </tr>
            </thead>
            <tbody>
                @php
                $roleColorMap = [
                    'startup'         => ['#57BD68','#f0fdf4'],
                    'investor'        => ['#1F3C88','#eff6ff'],
                    'mentor'          => ['#9333ea','#fdf4ff'],
                    'incubator'       => ['#ea580c','#fff7ed'],
                    'government_body' => ['#0284c7','#f0f9ff'],
                    'industry_expert' => ['#374151','#f9fafb'],
                    'super_admin'     => ['#FF8C42','#fff7ed'],
                ];
                @endphp

                @foreach($roleDetails as $key => $detail)
                @php [$rColor, $rBg] = $roleColorMap[$key] ?? ['#374151','#f9fafb']; @endphp
                <tr id="row-{{ $key }}" style="border-bottom:1px solid #f3f4f6; transition:background .15s, opacity .3s;"
                    class="{{ $detail['is_active'] ? '' : 'inactive-row' }}">

                    <td class="py-4 px-5 font-bold" style="color:#6b7280;">{{ $loop->iteration }}</td>

                    <td class="py-4 px-5">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-extrabold flex-shrink-0"
                                 style="background:{{ $rBg }}; color:{{ $rColor }};">
                                {{ strtoupper(substr($detail['label'], 0, 2)) }}
                            </div>
                            <div>
                                <p class="font-extrabold text-sm" style="color:#0d1b2a;">{{ $detail['label'] }}</p>
                                <p class="text-xs font-semibold" style="color:#6b7280;">{{ $key }}</p>
                            </div>
                        </div>
                    </td>

                    <td class="py-4 px-5">
                        <span class="text-xl font-extrabold" style="color:{{ $rColor }};">{{ $detail['total'] }}</span>
                    </td>

                    <td class="py-4 px-5">
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold" style="background:#f0fdf4; color:#57BD68;">
                            ✓ {{ $detail['verified'] }}
                        </span>
                    </td>

                    <td class="py-4 px-5">
                        @if($detail['pending'] > 0)
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold" style="background:#fef2f2; color:#ef4444;">
                            ✗ {{ $detail['pending'] }}
                        </span>
                        @else
                        <span class="text-xs font-bold" style="color:#9ca3af;">—</span>
                        @endif
                    </td>

                    <td class="py-4 px-5" style="min-width:140px;">
                        <div class="flex items-center gap-2">
                            <div class="flex-1 h-2 rounded-full" style="background:#f3f4f6;">
                                <div class="h-2 rounded-full" style="width:{{ $detail['percent'] }}%; background:{{ $rColor }};"></div>
                            </div>
                            <span class="text-xs font-bold" style="color:#0d1b2a;">{{ $detail['percent'] }}%</span>
                        </div>
                    </td>

                    <td class="py-4 px-5">
                        @if($detail['latest'])
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-extrabold text-white flex-shrink-0"
                                 style="background:{{ $rColor }};">
                                {{ strtoupper(substr($detail['latest']->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-xs font-bold" style="color:#0d1b2a;">{{ $detail['latest']->name }}</p>
                                <p class="text-xs font-semibold" style="color:#6b7280;">{{ $detail['latest']->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        @else
                        <span class="text-xs font-bold" style="color:#9ca3af;">No users yet</span>
                        @endif
                    </td>

                    <!-- Toggle -->
                    <td class="py-4 px-5" onclick="event.stopPropagation()">
                        @if($key === 'super_admin')
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full" style="background:#fff7ed; color:#FF8C42;">Protected</span>
                        @else
                        <div class="flex items-center gap-2">
                            <!-- Toggle switch -->
                            <button type="button"
                                id="toggle-{{ $key }}"
                                onclick="toggleRole('{{ $key }}')"
                                class="toggle-btn relative inline-flex items-center rounded-full transition-all duration-300 focus:outline-none"
                                style="width:44px; height:24px; background:{{ $detail['is_active'] ? '#57BD68' : '#d1d5db' }};"
                                data-active="{{ $detail['is_active'] ? 'true' : 'false' }}">
                                <span class="toggle-dot absolute rounded-full bg-white shadow transition-all duration-300"
                                      style="width:18px; height:18px; top:3px; left:{{ $detail['is_active'] ? '23px' : '3px' }};"></span>
                            </button>
                            <span id="status-label-{{ $key }}" class="text-xs font-bold"
                                  style="color:{{ $detail['is_active'] ? '#57BD68' : '#9ca3af' }};">
                                {{ $detail['is_active'] ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        @endif
                    </td>

                    <td class="py-4 px-5">
                        <a href="{{ route('dashboard.super-admin.users-page', ['filter' => 'role:'.$key]) }}"
                           class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-bold transition-all"
                           style="background:{{ $rBg }}; color:{{ $rColor }};">
                            View
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
.inactive-row { opacity: 0.55; }
.toggle-btn:hover { filter: brightness(0.92); }
</style>

<script>
const TOGGLE_URL = '{{ route("dashboard.super-admin.roles.toggle") }}';
const CSRF       = '{{ csrf_token() }}';

function toggleRole(role) {
    const btn   = document.getElementById('toggle-' + role);
    const dot   = btn.querySelector('.toggle-dot');
    const label = document.getElementById('status-label-' + role);
    const row   = document.getElementById('row-' + role);

    // Disable during request
    btn.disabled = true;
    btn.style.opacity = '0.6';

    fetch(TOGGLE_URL, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': CSRF,
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: JSON.stringify({ role })
    })
    .then(r => r.json())
    .then(data => {
        if (data.error) { showToast(data.error, false); return; }

        const active = data.is_active;

        // Update toggle appearance
        btn.style.background  = active ? '#57BD68' : '#d1d5db';
        dot.style.left        = active ? '23px' : '3px';
        label.textContent     = active ? 'Active' : 'Inactive';
        label.style.color     = active ? '#57BD68' : '#9ca3af';
        btn.dataset.active    = active ? 'true' : 'false';

        // Dim row if inactive
        row.classList.toggle('inactive-row', !active);

        showToast(
            active ? `"${role.replace(/_/g,' ')}" role activated` : `"${role.replace(/_/g,' ')}" role deactivated`,
            active
        );
    })
    .catch(() => showToast('Something went wrong. Please try again.', false))
    .finally(() => {
        btn.disabled = false;
        btn.style.opacity = '1';
    });
}

function showToast(msg, success) {
    const toast = document.getElementById('toast');
    toast.textContent     = msg;
    toast.style.background = success ? '#57BD68' : '#ef4444';
    toast.style.color      = '#fff';
    toast.style.display    = 'block';
    setTimeout(() => { toast.style.display = 'none'; }, 3000);
}
</script>

@endsection
