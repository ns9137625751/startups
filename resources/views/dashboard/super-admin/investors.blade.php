@extends('dashboard.layout')
@section('title', 'Investor Profiles')

@section('dashboard_content')

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
            <h1 class="text-2xl font-extrabold" style="color:#0d1b2a;">Investor Profiles</h1>
            <p id="total-count" class="text-sm font-semibold mt-0.5" style="color:#4b5563;">Loading...</p>
        </div>
    </div>
    <div class="flex items-center gap-2 flex-wrap">
        @foreach(['all'=>'All','pending'=>'Pending','approved'=>'Approved','rejected'=>'Rejected'] as $val=>$label)
        <button onclick="setFilter('{{ $val }}')" data-filter="{{ $val }}"
           class="filter-tab px-3 py-1.5 rounded-lg text-xs font-bold border transition-all"
           style="{{ $val === 'all' ? 'background:#1F3C88;color:#fff;border-color:#1F3C88;' : 'background:#fff;color:#6b7280;border-color:#e5e7eb;' }}">
            {{ $label }}
        </button>
        @endforeach

        <!-- Export -->
        <a href="{{ route('dashboard.super-admin.investors.export') }}"
           class="px-3 py-1.5 rounded-lg text-xs font-bold border flex items-center gap-1"
           style="background:#f0fdf4;color:#16a34a;border-color:#bbf7d0;"
           onmouseover="this.style.background='#16a34a';this.style.color='#fff'"
           onmouseout="this.style.background='#f0fdf4';this.style.color='#16a34a'">
            &#11123; Export Excel
        </a>

        <!-- Import trigger -->
        <button onclick="document.getElementById('investor-import-modal').style.display='flex'"
           class="px-3 py-1.5 rounded-lg text-xs font-bold border flex items-center gap-1"
           style="background:#eff6ff;color:#1F3C88;border-color:#bfdbfe;"
           onmouseover="this.style.background='#1F3C88';this.style.color='#fff'"
           onmouseout="this.style.background='#eff6ff';this.style.color='#1F3C88'">
            &#11121; Import Excel
        </button>
    </div>
</div>

<!-- Import Modal -->
<div id="investor-import-modal"
     style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.45);z-index:50;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:16px;padding:28px 32px;width:100%;max-width:480px;box-shadow:0 20px 60px rgba(0,0,0,0.15);">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-base font-extrabold" style="color:#0d1b2a;">Import Investor Profiles</h2>
            <button onclick="document.getElementById('investor-import-modal').style.display='none'"
                    style="background:none;border:none;font-size:20px;color:#9ca3af;cursor:pointer;">&#10005;</button>
        </div>

        <!-- Instructions -->
        <div class="mb-4 p-3 rounded-lg text-xs font-semibold" style="background:#fffbeb;color:#92400e;border:1px solid #fde68a;">
            <p class="font-extrabold mb-1">&#9888; Required columns in your Excel file:</p>
            <p>fund_name, fund_email, fund_mobile_number, fund_brief, partner_name, partner_email, partner_mobile_number, ticket_size, city, state</p>
            <p class="mt-1">Optional: investment_sectors (comma-separated domain IDs), portfolio_companies, website, logo, founder_img</p>
        </div>

        <div class="mb-4">
            <a href="{{ route('dashboard.super-admin.investors.template') }}"
               class="text-xs font-bold flex items-center gap-1"
               style="color:#1F3C88;">
                &#11123; Download Template
            </a>
        </div>

        @if(session('error'))
        <div class="mb-3 px-3 py-2 rounded-lg text-xs font-bold text-white" style="background:#ef4444;">
            {{ session('error') }}
        </div>
        @endif

        <form method="POST" action="{{ route('dashboard.super-admin.investors.import') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-xs font-extrabold mb-1.5" style="color:#374151;">Select Excel / CSV File</label>
                <input type="file" name="file" accept=".xlsx,.xls,.csv" required
                       style="width:100%;border:1.5px solid #e5e7eb;border-radius:8px;padding:8px 10px;font-size:12px;font-weight:600;outline:none;">
                <p class="text-xs mt-1" style="color:#9ca3af;">Accepted: .xlsx, .xls, .csv — Max 10MB</p>
            </div>
            <div class="flex items-center gap-2 justify-end">
                <button type="button" onclick="document.getElementById('investor-import-modal').style.display='none'"
                        class="px-4 py-2 rounded-lg text-xs font-bold border"
                        style="background:#fff;color:#6b7280;border-color:#e5e7eb;">Cancel</button>
                <button type="submit"
                        class="px-4 py-2 rounded-lg text-xs font-bold text-white"
                        style="background:#1F3C88;border:none;cursor:pointer;"
                        onmouseover="this.style.background='#162d6e'" onmouseout="this.style.background='#1F3C88'">&#11121; Import</button>
            </div>
        </form>
    </div>
</div>

@if(session('success'))
<div class="mb-4 px-4 py-3 rounded-lg text-sm font-bold text-white" style="background:#57BD68;">
    {{ session('success') }}
</div>
@endif

<div class="mb-5 flex items-start gap-3 flex-wrap">
    <!-- Search -->
    <div class="relative" style="min-width:260px;">
        <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2" style="color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        <input id="search-input" type="text" placeholder="Search fund, partner, email, city..."
            style="width:100%;border:1.5px solid #e5e7eb;border-radius:10px;padding:9px 36px 9px 34px;font-size:13px;font-weight:600;outline:none;"
            onfocus="this.style.borderColor='#1F3C88'" onblur="this.style.borderColor='#e5e7eb'">
        <span id="clear-btn" onclick="clearSearch()"
           style="display:none;position:absolute;right:10px;top:50%;transform:translateY(-50%);color:#9ca3af;font-size:18px;cursor:pointer;">×</span>
    </div>

    <!-- Domain filter dropdown -->
    <div class="relative">
        <select id="domain-select" onchange="setDomain(this.value)"
            style="border:1.5px solid #e5e7eb;border-radius:10px;padding:9px 36px 9px 12px;font-size:13px;font-weight:600;outline:none;color:#374151;background:#fff;appearance:none;cursor:pointer;min-width:180px;"
            onfocus="this.style.borderColor='#1F3C88'" onblur="this.style.borderColor='#e5e7eb'">
            <option value="">All Domains</option>
            @foreach($domains as $domain)
            <option value="{{ $domain->id }}">{{ $domain->name }}</option>
            @endforeach
        </select>
        <svg class="w-4 h-4 pointer-events-none" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </div>

    <!-- Per page -->
    <div class="flex items-center gap-2 ml-auto">
        <span class="text-xs font-semibold" style="color:#6b7280;">Rows per page:</span>
        <select id="per-page-select" onchange="setPerPage(this.value)"
            style="border:1.5px solid #e5e7eb;border-radius:10px;padding:7px 12px;font-size:13px;font-weight:600;outline:none;color:#374151;background:#fff;cursor:pointer;"
            onfocus="this.style.borderColor='#1F3C88'" onblur="this.style.borderColor='#e5e7eb'">
            <option value="15">15</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
    </div>
</div>

<div class="bg-white border rounded-xl overflow-hidden" style="border-color:#e5e7eb;">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead style="background:#f9fafb;">
                <tr>
                    <th class="text-left py-3 px-4 text-xs font-extrabold" style="color:#0d1b2a;">Sr.</th>
                    <th class="text-left py-3 px-4 text-xs font-extrabold" style="color:#0d1b2a;">Fund Name</th>
                    <th class="text-left py-3 px-4 text-xs font-extrabold" style="color:#0d1b2a;">Partner</th>
                    <th class="text-left py-3 px-4 text-xs font-extrabold" style="color:#0d1b2a;">Email</th>
                    <th class="text-left py-3 px-4 text-xs font-extrabold" style="color:#0d1b2a;">Mobile</th>
                    <th class="text-left py-3 px-4 text-xs font-extrabold" style="color:#0d1b2a;">Ticket Size</th>
                    <th class="text-left py-3 px-4 text-xs font-extrabold" style="color:#0d1b2a;">Sectors</th>
                    <th class="text-left py-3 px-4 text-xs font-extrabold" style="color:#0d1b2a;">Status</th>
                    <th class="text-left py-3 px-4 text-xs font-extrabold" style="color:#0d1b2a;">Actions</th>
                </tr>
            </thead>
            <tbody id="investors-tbody">
                <tr><td colspan="9" class="py-16 text-center text-xs font-semibold" style="color:#6b7280;">Loading...</td></tr>
            </tbody>
        </table>
    </div>
    <div id="pagination-wrap" class="flex items-center justify-between px-5 py-4 border-t" style="border-color:#f3f4f6;display:none;">
        <p id="pagination-info" class="text-xs font-semibold" style="color:#6b7280;"></p>
        <div id="pagination-links" class="flex items-center gap-1"></div>
    </div>
</div>

<script>
const SEARCH_URL   = '{{ route("dashboard.super-admin.investors.search") }}';
const LS_KEY       = 'sa_investors_perPage';
let currentFilter  = 'all', currentDomain = '', currentPage = 1, searchTimer = null;
let currentPerPage = parseInt(localStorage.getItem(LS_KEY)) || 15;

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('per-page-select').value = currentPerPage;
    @if(session('error'))
    document.getElementById('investor-import-modal').style.display = 'flex';
    @endif
    fetchData();
});

function setPerPage(val) {
    currentPerPage = parseInt(val);
    localStorage.setItem(LS_KEY, currentPerPage);
    currentPage = 1;
    fetchData();
}

function setFilter(filter) {
    currentFilter = filter; currentPage = 1;
    document.querySelectorAll('.filter-tab').forEach(btn => {
        const active = btn.dataset.filter === filter;
        btn.style.background  = active ? '#1F3C88' : '#fff';
        btn.style.color       = active ? '#fff'    : '#6b7280';
        btn.style.borderColor = active ? '#1F3C88' : '#e5e7eb';
    });
    fetchData();
}

function setDomain(domain) {
    currentDomain = domain;
    currentPage   = 1;
    fetchData();
}

function clearSearch() {
    document.getElementById('search-input').value = '';
    document.getElementById('clear-btn').style.display = 'none';
    currentPage = 1; fetchData();
}

document.getElementById('search-input').addEventListener('input', function () {
    document.getElementById('clear-btn').style.display = this.value ? 'block' : 'none';
    clearTimeout(searchTimer); currentPage = 1;
    searchTimer = setTimeout(fetchData, 350);
});

function fetchData() {
    const q = document.getElementById('search-input').value;
    const params = new URLSearchParams({ q, filter: currentFilter, domain: currentDomain, page: currentPage, perPage: currentPerPage });
    document.getElementById('investors-tbody').innerHTML =
        '<tr><td colspan="9" class="py-16 text-center text-xs font-semibold" style="color:#6b7280;">Loading...</td></tr>';
    fetch(SEARCH_URL + '?' + params.toString(), { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(r => r.json()).then(renderTable)
        .catch(() => {
            document.getElementById('investors-tbody').innerHTML =
                '<tr><td colspan="9" class="py-16 text-center text-xs font-semibold" style="color:#ef4444;">Failed to load data.</td></tr>';
        });
}

function renderTable(data) {
    document.getElementById('total-count').textContent = data.total + ' total submissions';
    const tbody = document.getElementById('investors-tbody');
    if (!data.rows.length) {
        const msg = document.getElementById('search-input').value ? 'Try a different search' : 'No submissions yet';
        tbody.innerHTML = `<tr><td colspan="9" class="py-16 text-center"><p class="font-extrabold text-sm" style="color:#0d1b2a;">No investor profiles found</p><p class="text-xs font-semibold mt-1" style="color:#6b7280;">${msg}</p></td></tr>`;
        document.getElementById('pagination-wrap').style.display = 'none';
        return;
    }
    tbody.innerHTML = data.rows.map(r => `
        <tr style="border-bottom:1px solid #f3f4f6;" onmouseover="this.style.background='#fafafa'" onmouseout="this.style.background=''">
            <td class="py-3 px-4 text-xs font-bold" style="color:#6b7280;">${r.sr}</td>
            <td class="py-3 px-4">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-extrabold text-white flex-shrink-0"
                         style="background:linear-gradient(135deg,#FF8C42,#e07030);">${r.initial}</div>
                    <p class="font-extrabold text-xs" style="color:#0d1b2a;">${r.fund_name}</p>
                </div>
            </td>
            <td class="py-3 px-4 text-xs font-semibold" style="color:#0d1b2a;">${r.partner_name}</td>
            <td class="py-3 px-4 text-xs font-semibold" style="color:#4b5563;">${r.fund_email}</td>
            <td class="py-3 px-4 text-xs font-semibold" style="color:#4b5563;">${r.fund_mobile}</td>
            <td class="py-3 px-4 text-xs font-bold" style="color:#0d1b2a;">${r.ticket_size}</td>
            <td class="py-3 px-4">
                <span class="px-2 py-1 rounded-full text-xs font-bold" style="background:#fff7ed;color:#FF8C42;">${r.sectors}</span>
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
                    <form method="POST" action="${r.deleteUrl}" onsubmit="return confirm('Delete this investor profile?')">
                        <input type="hidden" name="_token" value="${r.csrf}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="px-2.5 py-1 rounded-lg text-xs font-bold" style="background:#fef2f2;color:#ef4444;border:none;cursor:pointer;"
                            onmouseover="this.style.background='#ef4444';this.style.color='#fff'"
                            onmouseout="this.style.background='#fef2f2';this.style.color='#ef4444'">&#128465; Delete</button>
                    </form>
                    ${r.canApprove ? `<button onclick="approveInvestor('${r.approveUrl}','${r.csrf}')" class="px-2.5 py-1 rounded-lg text-xs font-bold" style="background:#dcfce7;color:#16a34a;border:none;cursor:pointer;" onmouseover="this.style.background='#16a34a';this.style.color='#fff'" onmouseout="this.style.background='#dcfce7';this.style.color='#16a34a'">&#10004; Approve</button>` : ''}
                </div>
            </td>
        </tr>`).join('');
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
    let html = data.page <= 1
        ? `<span class="px-3 py-1.5 rounded-lg text-xs font-bold border" style="color:#d1d5db;border-color:#e5e7eb;">← Prev</span>`
        : `<button onclick="goPage(${data.page-1})" class="px-3 py-1.5 rounded-lg text-xs font-bold border" style="color:#1F3C88;border-color:#1F3C88;background:#fff;" onmouseover="this.style.background='#1F3C88';this.style.color='#fff'" onmouseout="this.style.background='#fff';this.style.color='#1F3C88'">← Prev</button>`;
    for (let p = Math.max(1,data.page-2); p <= Math.min(data.lastPage,data.page+2); p++) {
        html += p === data.page
            ? `<span class="px-3 py-1.5 rounded-lg text-xs font-bold text-white" style="background:#1F3C88;">${p}</span>`
            : `<button onclick="goPage(${p})" class="px-3 py-1.5 rounded-lg text-xs font-bold border" style="color:#1F3C88;border-color:#e5e7eb;background:#fff;" onmouseover="this.style.borderColor='#1F3C88'" onmouseout="this.style.borderColor='#e5e7eb'">${p}</button>`;
    }
    html += data.page >= data.lastPage
        ? `<span class="px-3 py-1.5 rounded-lg text-xs font-bold border" style="color:#d1d5db;border-color:#e5e7eb;">Next →</span>`
        : `<button onclick="goPage(${data.page+1})" class="px-3 py-1.5 rounded-lg text-xs font-bold border" style="color:#1F3C88;border-color:#1F3C88;background:#fff;" onmouseover="this.style.background='#1F3C88';this.style.color='#fff'" onmouseout="this.style.background='#fff';this.style.color='#1F3C88'">Next →</button>`;
    links.innerHTML = html;
}

function goPage(page) { currentPage = page; fetchData(); }

function approveInvestor(url, csrf) {
    fetch(url, {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Content-Type': 'application/x-www-form-urlencoded' },
        body: '_token=' + encodeURIComponent(csrf) + '&status=1'
    })
    .then(r => r.json())
    .then(() => fetchData())
    .catch(() => alert('Approval failed. Please try again.'));
}
</script>

@endsection
