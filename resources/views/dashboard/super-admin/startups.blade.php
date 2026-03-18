@extends('dashboard.layout')
@section('title', 'Startup Profiles')

@section('dashboard_content')

<!-- Header -->
<div class="mb-6 flex items-center justify-between">
    <div class="flex items-center gap-3">
        <a href="{{ route('dashboard.super-admin.index') }}"
           class="w-8 h-8 rounded-lg flex items-center justify-center border hover:bg-gray-50 transition-colors flex-shrink-0"
           style="border-color:#e5e7eb;">
            <svg class="w-4 h-4" style="color:#6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold" style="color:#0d1b2a;">Startup Profiles</h1>
            <p id="total-count" class="text-sm font-semibold mt-0.5" style="color:#4b5563;">Loading...</p>
        </div>
    </div>

    <!-- Filter tabs -->
    <div class="flex items-center gap-2">
        @foreach(['all'=>'All','pending'=>'Pending','approved'=>'Approved','rejected'=>'Rejected'] as $val=>$label)
        <button onclick="setFilter('{{ $val }}')" data-filter="{{ $val }}"
           class="filter-tab px-3 py-1.5 rounded-lg text-xs font-bold border transition-all"
           style="{{ $val === 'all' ? 'background:#1F3C88;color:#fff;border-color:#1F3C88;' : 'background:#fff;color:#6b7280;border-color:#e5e7eb;' }}">
            {{ $label }}
        </button>
        @endforeach
    </div>
</div>

@if(session('success'))
<div class="mb-4 px-4 py-3 rounded-lg text-sm font-bold text-white" style="background:#57BD68;">
    {{ session('success') }}
</div>
@endif

<!-- Search -->
<div class="mb-5">
    <div class="relative max-w-sm">
        <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2" style="color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        <input id="search-input" type="text" placeholder="Search company, founder, email..."
            style="width:100%;border:1.5px solid #e5e7eb;border-radius:10px;padding:9px 36px 9px 34px;font-size:13px;font-weight:600;outline:none;"
            onfocus="this.style.borderColor='#1F3C88'" onblur="this.style.borderColor='#e5e7eb'">
        <span id="clear-btn" onclick="clearSearch()"
           style="display:none;position:absolute;right:10px;top:50%;transform:translateY(-50%);color:#9ca3af;font-size:18px;cursor:pointer;">×</span>
    </div>
</div>

<!-- Table -->
<div class="bg-white border rounded-xl overflow-hidden" style="border-color:#e5e7eb;">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead style="background:#f9fafb;">
                <tr>
                    <th class="text-left py-3 px-4 text-xs font-extrabold" style="color:#0d1b2a;">Sr.</th>
                    <th class="text-left py-3 px-4 text-xs font-extrabold" style="color:#0d1b2a;">Startup Name</th>
                    <th class="text-left py-3 px-4 text-xs font-extrabold" style="color:#0d1b2a;">Founder Name</th>
                    <th class="text-left py-3 px-4 text-xs font-extrabold" style="color:#0d1b2a;">Email</th>
                    <th class="text-left py-3 px-4 text-xs font-extrabold" style="color:#0d1b2a;">Mobile</th>
                    <th class="text-left py-3 px-4 text-xs font-extrabold" style="color:#0d1b2a;">Domain</th>
                    <th class="text-left py-3 px-4 text-xs font-extrabold" style="color:#0d1b2a;">Status</th>
                    <th class="text-left py-3 px-4 text-xs font-extrabold" style="color:#0d1b2a;">Actions</th>
                </tr>
            </thead>
            <tbody id="startups-tbody">
                <tr><td colspan="8" class="py-16 text-center text-xs font-semibold" style="color:#6b7280;">Loading...</td></tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div id="pagination-wrap" class="flex items-center justify-between px-5 py-4 border-t" style="border-color:#f3f4f6;display:none;">
        <p id="pagination-info" class="text-xs font-semibold" style="color:#6b7280;"></p>
        <div id="pagination-links" class="flex items-center gap-1"></div>
    </div>
</div>

<script>
const SEARCH_URL = '{{ route("dashboard.super-admin.startups.search") }}';
let currentFilter = '{{ session("filter", "all") }}';
let currentPage   = 1;
let searchTimer   = null;

// Set initial filter state if passed from session
document.addEventListener('DOMContentLoaded', function() {
    if (currentFilter !== 'all') {
        setFilter(currentFilter);
    } else {
        fetchData();
    }
});

function setFilter(filter) {
    currentFilter = filter;
    currentPage   = 1;
    document.querySelectorAll('.filter-tab').forEach(btn => {
        const active = btn.dataset.filter === filter;
        btn.style.background    = active ? '#1F3C88' : '#fff';
        btn.style.color         = active ? '#fff'    : '#6b7280';
        btn.style.borderColor   = active ? '#1F3C88' : '#e5e7eb';
    });
    fetchData();
}

function clearSearch() {
    document.getElementById('search-input').value = '';
    document.getElementById('clear-btn').style.display = 'none';
    currentPage = 1;
    fetchData();
}

document.getElementById('search-input').addEventListener('input', function () {
    document.getElementById('clear-btn').style.display = this.value ? 'block' : 'none';
    clearTimeout(searchTimer);
    currentPage = 1;
    searchTimer = setTimeout(fetchData, 350);
});

function fetchData() {
    const q = document.getElementById('search-input').value;
    const params = new URLSearchParams({ q, filter: currentFilter, page: currentPage });

    document.getElementById('startups-tbody').innerHTML =
        '<tr><td colspan="8" class="py-16 text-center text-xs font-semibold" style="color:#6b7280;">Loading...</td></tr>';

    fetch(SEARCH_URL + '?' + params.toString(), {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.json())
    .then(data => renderTable(data))
    .catch(() => {
        document.getElementById('startups-tbody').innerHTML =
            '<tr><td colspan="8" class="py-16 text-center text-xs font-semibold" style="color:#ef4444;">Failed to load data.</td></tr>';
    });
}

function renderTable(data) {
    document.getElementById('total-count').textContent = data.total + ' total submissions';

    const tbody = document.getElementById('startups-tbody');
    if (data.rows.length === 0) {
        const msg = document.getElementById('search-input').value ? 'Try a different search' : 'No submissions yet';
        tbody.innerHTML = `<tr><td colspan="8" class="py-16 text-center"><p class="font-extrabold text-sm" style="color:#0d1b2a;">No startup profiles found</p><p class="text-xs font-semibold mt-1" style="color:#6b7280;">${msg}</p></td></tr>`;
        document.getElementById('pagination-wrap').style.display = 'none';
        return;
    }

    tbody.innerHTML = data.rows.map(r => `
        <tr style="border-bottom:1px solid #f3f4f6;" onmouseover="this.style.background='#fafafa'" onmouseout="this.style.background=''">
            <td class="py-3 px-4 text-xs font-bold" style="color:#6b7280;">${r.sr}</td>
            <td class="py-3 px-4">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-extrabold text-white flex-shrink-0"
                         style="background:linear-gradient(135deg,#1F3C88,#3b5fc0);">${r.initial}</div>
                    <div>
                        <p class="font-extrabold text-xs" style="color:#0d1b2a;">${r.company}</p>
                        <p class="text-xs font-semibold" style="color:#6b7280;">${r.stage}</p>
                    </div>
                </div>
            </td>
            <td class="py-3 px-4 text-xs font-semibold" style="color:#0d1b2a;">${r.founder}</td>
            <td class="py-3 px-4 text-xs font-semibold" style="color:#4b5563;">${r.email}</td>
            <td class="py-3 px-4 text-xs font-semibold" style="color:#4b5563;">${r.contact}</td>
            <td class="py-3 px-4">
                <span class="px-2 py-1 rounded-full text-xs font-bold" style="background:#eff6ff;color:#1F3C88;">${r.domain}</span>
            </td>
            <td class="py-3 px-4">${r.badge}</td>
            <td class="py-3 px-4">
                <div class="flex items-center gap-1.5 flex-wrap">
                    <a href="${r.showUrl}" class="px-2.5 py-1 rounded-lg text-xs font-bold" style="background:#eff6ff;color:#1F3C88;"
                       onmouseover="this.style.background='#1F3C88';this.style.color='#fff'"
                       onmouseout="this.style.background='#eff6ff';this.style.color='#1F3C88'">&#128065; Show</a>
                    <a href="${r.editUrl}" class="px-2.5 py-1 rounded-lg text-xs font-bold" style="background:#f0fdf4;color:#57BD68;"
                       onmouseover="this.style.background='#57BD68';this.style.color='#fff'"
                       onmouseout="this.style.background='#f0fdf4';this.style.color='#57BD68'">&#9999; Edit</a>
                    <form method="POST" action="${r.deleteUrl}" onsubmit="return confirm('Delete this startup profile? This cannot be undone.')">
                        <input type="hidden" name="_token" value="${r.csrf}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="px-2.5 py-1 rounded-lg text-xs font-bold" style="background:#fef2f2;color:#ef4444;border:none;cursor:pointer;"
                            onmouseover="this.style.background='#ef4444';this.style.color='#fff'"
                            onmouseout="this.style.background='#fef2f2';this.style.color='#ef4444'">&#128465; Delete</button>
                    </form>
                    ${r.approveBtn}
                </div>
            </td>
        </tr>
    `).join('');

    // Update filter inputs in approve forms
    document.querySelectorAll('#filter-input').forEach(input => {
        input.value = currentFilter;
    });

    renderPagination(data);
}

function renderPagination(data) {
    const wrap = document.getElementById('pagination-wrap');
    if (data.lastPage <= 1) { wrap.style.display = 'none'; return; }

    wrap.style.display = 'flex';
    const from = (data.page - 1) * data.perPage + 1;
    const to   = Math.min(data.page * data.perPage, data.total);
    document.getElementById('pagination-info').textContent = `Showing ${from}–${to} of ${data.total}`;

    const links = document.getElementById('pagination-links');
    let html = '';

    const prevDisabled = data.page <= 1;
    html += prevDisabled
        ? `<span class="px-3 py-1.5 rounded-lg text-xs font-bold border" style="color:#d1d5db;border-color:#e5e7eb;">← Prev</span>`
        : `<button onclick="goPage(${data.page - 1})" class="px-3 py-1.5 rounded-lg text-xs font-bold border" style="color:#1F3C88;border-color:#1F3C88;background:#fff;" onmouseover="this.style.background='#1F3C88';this.style.color='#fff'" onmouseout="this.style.background='#fff';this.style.color='#1F3C88'">← Prev</button>`;

    const start = Math.max(1, data.page - 2);
    const end   = Math.min(data.lastPage, data.page + 2);
    for (let p = start; p <= end; p++) {
        if (p === data.page) {
            html += `<span class="px-3 py-1.5 rounded-lg text-xs font-bold text-white" style="background:#1F3C88;">${p}</span>`;
        } else {
            html += `<button onclick="goPage(${p})" class="px-3 py-1.5 rounded-lg text-xs font-bold border" style="color:#1F3C88;border-color:#e5e7eb;background:#fff;" onmouseover="this.style.borderColor='#1F3C88'" onmouseout="this.style.borderColor='#e5e7eb'">${p}</button>`;
        }
    }

    const nextDisabled = data.page >= data.lastPage;
    html += nextDisabled
        ? `<span class="px-3 py-1.5 rounded-lg text-xs font-bold border" style="color:#d1d5db;border-color:#e5e7eb;">Next →</span>`
        : `<button onclick="goPage(${data.page + 1})" class="px-3 py-1.5 rounded-lg text-xs font-bold border" style="color:#1F3C88;border-color:#1F3C88;background:#fff;" onmouseover="this.style.background='#1F3C88';this.style.color='#fff'" onmouseout="this.style.background='#fff';this.style.color='#1F3C88'">Next →</button>`;

    links.innerHTML = html;
}

function goPage(page) {
    currentPage = page;
    fetchData();
}

</script>

@endsection
