@extends('dashboard.layout')
@section('title', 'Contact Messages')

@section('dashboard_content')

<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold" style="color:#0d1b2a;">Contact Messages</h1>
        <p class="text-sm mt-1" style="color:#4b5563;">All messages submitted via the Contact Us form</p>
    </div>
    <span class="text-xs bg-white border rounded-lg px-3 py-1.5" style="border-color:#e5e7eb; color:#6b7280;">
        {{ $contacts->total() }} total
    </span>
</div>

@if(session('success'))
<div class="rounded-lg px-4 py-3 mb-5 text-sm font-semibold flex items-center gap-2" style="background:#f0fdf4; border:1px solid #A7E4B5; color:#2F8F46;">
    ✅ {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-xl border overflow-hidden" style="border-color:#e5e7eb;">
    <table class="w-full text-sm">
        <thead>
            <tr style="background:#f9fafb; border-bottom:1px solid #e5e7eb;">
                <th class="text-left px-5 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6b7280;">#</th>
                <th class="text-left px-5 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6b7280;">Name</th>
                <th class="text-left px-5 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6b7280;">Email</th>
                <th class="text-left px-5 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6b7280;">Organization</th>
                <th class="text-left px-5 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6b7280;">Message</th>
                <th class="text-left px-5 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6b7280;">Date</th>
                <th class="px-5 py-3"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($contacts as $i => $contact)
            <tr class="border-b hover:bg-gray-50 transition-colors" style="border-color:#f3f4f6;">
                <td class="px-5 py-4 text-xs" style="color:#9ca3af;">{{ $contacts->firstItem() + $i }}</td>
                <td class="px-5 py-4 font-semibold" style="color:#0d1b2a;">{{ $contact->name }}</td>
                <td class="px-5 py-4" style="color:#4b5563;">{{ $contact->email }}</td>
                <td class="px-5 py-4" style="color:#4b5563;">{{ $contact->organization ?: '—' }}</td>
                <td class="px-5 py-4 max-w-xs">
                    <p class="truncate text-xs" style="color:#6b7280;" title="{{ $contact->message }}">{{ $contact->message }}</p>
                    <button onclick="document.getElementById('msg-{{ $contact->id }}').classList.toggle('hidden')"
                        class="text-xs font-semibold mt-1" style="color:#57BD68;">View full</button>
                    <p id="msg-{{ $contact->id }}" class="hidden text-xs mt-1 leading-relaxed" style="color:#374151; white-space:pre-wrap;">{{ $contact->message }}</p>
                </td>
                <td class="px-5 py-4 text-xs whitespace-nowrap" style="color:#9ca3af;">{{ $contact->created_at->format('d M Y, H:i') }}</td>
                <td class="px-5 py-4">
                    <form method="POST" action="{{ route('dashboard.super-admin.contacts.delete', $contact->id) }}"
                          onsubmit="return confirm('Delete this message?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs font-semibold px-3 py-1.5 rounded-lg transition-colors"
                            style="background:#fef2f2; color:#ef4444;"
                            onmouseover="this.style.background='#ef4444';this.style.color='#fff'"
                            onmouseout="this.style.background='#fef2f2';this.style.color='#ef4444'">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-5 py-12 text-center text-sm" style="color:#9ca3af;">No contact messages yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($contacts->hasPages())
<div class="mt-4">{{ $contacts->links() }}</div>
@endif

@endsection
