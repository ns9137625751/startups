@extends('dashboard.layout')
@section('title', '{{ $title }} – Super Admin')

@section('dashboard_content')

<!-- Header -->
<div class="mb-6 flex items-center justify-between">
    <div class="flex items-center gap-3">
        <a href="{{ route('dashboard.super-admin.index') }}"
           class="w-8 h-8 rounded-lg flex items-center justify-center border hover:bg-gray-50 transition-colors"
           style="border-color:#e5e7eb;">
            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold" style="color:#0d1b2a;">{{ $title }}</h1>
            <p class="text-sm text-gray-500 mt-0.5">
                Showing <span id="resultCount" class="font-semibold" style="color:#57BD68;">–</span> users
            </p>
        </div>
    </div>

    <!-- Filter tabs -->
    <div class="flex items-center gap-2 flex-wrap">
        @php
        $tabs = [
            'all'        => 'All',
            'verified'   => 'Verified',
            'unverified' => 'Unverified',
        ];
        foreach ($roles as $rk => $rl) {
            $tabs['role:' . $rk] = $rl;
        }
        @endphp
        @foreach($tabs as $tabFilter => $tabLabel)
        <a href="{{ route('dashboard.super-admin.users-page', ['filter' => $tabFilter]) }}"
           class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-all border"
           style="{{ $filter === $tabFilter
               ? 'background:#57BD68; color:#fff; border-color:#57BD68;'
               : 'background:#fff; color:#6b7280; border-color:#e5e7eb;' }}">
            {{ $tabLabel }}
        </a>
        @endforeach
    </div>
</div>

<!-- Table Card -->
<div class="bg-white border rounded-xl overflow-hidden" style="border-color:#e5e7eb;">

    <!-- Search bar -->
    <div class="flex items-center justify-between gap-4 px-5 py-4 border-b" style="border-color:#f3f4f6;">
        <div class="relative flex-1 max-w-sm">
            <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" id="searchInput" placeholder="Search by name or email..."
                style="width:100%; border:1.5px solid #e5e7eb; border-radius:8px;
                       padding:8px 36px 8px 34px; font-size:13px; outline:none; transition:all .2s;"
                onfocus="this.style.borderColor='#57BD68'; this.style.boxShadow='0 0 0 3px rgba(87,189,104,0.1)'"
                onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'">
            <button id="clearBtn" onclick="clearSearch()"
                style="display:none; position:absolute; right:10px; top:50%; transform:translateY(-50%);
                       background:none; border:none; cursor:pointer; color:#9ca3af; font-size:18px; line-height:1;">
                ×
            </button>
        </div>
        <div class="text-xs text-gray-400">
            Active filter: <span class="font-semibold" style="color:#57BD68;">{{ $title }}</span>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead style="background:#f9fafb;">
                <tr>
                    <th class="text-left py-3 px-5 text-xs font-semibold text-gray-500 w-10">#</th>
                    <th class="text-left py-3 px-5 text-xs font-semibold text-gray-500">Name</th>
                    <th class="text-left py-3 px-5 text-xs font-semibold text-gray-500">Email</th>
                    <th class="text-left py-3 px-5 text-xs font-semibold text-gray-500">Role</th>
                    <th class="text-left py-3 px-5 text-xs font-semibold text-gray-500">Status</th>
                    <th class="text-left py-3 px-5 text-xs font-semibold text-gray-500">Joined</th>
                </tr>
            </thead>
            <tbody id="usersTableBody">
                <tr>
                    <td colspan="6" class="py-12 text-center">
                        <div class="flex flex-col items-center gap-2">
                            <svg class="w-6 h-6 animate-spin" style="color:#57BD68;" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                            </svg>
                            <span class="text-xs text-gray-400">Loading users...</span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Empty state -->
    <div id="emptyState" style="display:none;" class="py-20 text-center">
        <svg class="w-14 h-14 mx-auto mb-4 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        <p class="text-gray-400 font-medium">No users found</p>
        <p class="text-gray-300 text-xs mt-1">Try a different search term</p>
    </div>
</div>

<style>
#usersTableBody tr { border-bottom: 1px solid #f9fafb; transition: background .15s; }
#usersTableBody tr:last-child { border-bottom: none; }
#usersTableBody tr:hover { background: #fafafa; }
</style>

<script>
const AJAX_URL  = '{{ route("dashboard.super-admin.users") }}';
const FILTER    = '{{ $filter }}';
let searchTimer = null;

document.addEventListener('DOMContentLoaded', () => {
    fetchUsers();
    document.getElementById('searchInput').addEventListener('input', function () {
        document.getElementById('clearBtn').style.display = this.value ? 'block' : 'none';
        clearTimeout(searchTimer);
        searchTimer = setTimeout(fetchUsers, 300);
    });
});

function clearSearch() {
    document.getElementById('searchInput').value = '';
    document.getElementById('clearBtn').style.display = 'none';
    fetchUsers();
}

function fetchUsers() {
    const q = document.getElementById('searchInput').value.trim();
    fetch(`${AJAX_URL}?filter=${encodeURIComponent(FILTER)}&q=${encodeURIComponent(q)}`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.json())
    .then(data => renderTable(data.users, data.total))
    .catch(() => {
        document.getElementById('usersTableBody').innerHTML =
            '<tr><td colspan="6" class="py-8 text-center text-red-400 text-sm">Failed to load. Please refresh.</td></tr>';
    });
}

function renderTable(users, total) {
    const tbody = document.getElementById('usersTableBody');
    const empty = document.getElementById('emptyState');
    document.getElementById('resultCount').textContent = total;

    if (users.length === 0) {
        tbody.innerHTML = '';
        empty.style.display = 'block';
        return;
    }
    empty.style.display = 'none';

    tbody.innerHTML = users.map((u, i) => `
        <tr>
            <td class="py-3 px-5 text-xs text-gray-400">${i + 1}</td>
            <td class="py-3 px-5">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold text-white flex-shrink-0"
                         style="background:${u.role_text};">
                        ${esc(u.name).charAt(0).toUpperCase()}
                    </div>
                    <span class="font-medium text-gray-800">${esc(u.name)}</span>
                </div>
            </td>
            <td class="py-3 px-5 text-gray-500">${esc(u.email)}</td>
            <td class="py-3 px-5">
                <span class="px-2.5 py-1 rounded-full text-xs font-semibold capitalize"
                      style="background:${u.role_bg}; color:${u.role_text};">
                    ${esc(u.role)}
                </span>
            </td>
            <td class="py-3 px-5">
                ${u.verified
                    ? '<span class="px-2.5 py-1 rounded-full text-xs font-semibold" style="background:#f0fdf4;color:#57BD68;">✓ Verified</span>'
                    : '<span class="px-2.5 py-1 rounded-full text-xs font-semibold" style="background:#fef2f2;color:#ef4444;">✗ Pending</span>'
                }
            </td>
            <td class="py-3 px-5 text-gray-400 text-xs">${u.joined}</td>
        </tr>
    `).join('');
}

function esc(s) {
    return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}
</script>

@endsection
