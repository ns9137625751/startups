@extends('layouts.app')
@section('title', 'FAQ – Startup Investment & Government Grants Questions India | StartupEco')
@section('meta_description', 'Frequently asked questions about StartupEco. Learn how to get startup funding, find investors, apply for government grants and join incubation programs in India and Gujarat.')
@section('meta_keywords', 'startup FAQ India, startup investment questions, government grant FAQ India, how to find investors India, startup incubator FAQ, startup funding questions Gujarat')
@section('structured_data')
<script type="application/ld+json">
@verbatim
{
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
        {"@type": "Question", "name": "What is StartupEco?", "acceptedAnswer": {"@type": "Answer", "text": "StartupEco connects startups with investors, incubators, government programs, and industry mentors to support the growth of innovative businesses in India."}},
        {"@type": "Question", "name": "Who can join this platform?", "acceptedAnswer": {"@type": "Answer", "text": "The platform is open to Startups, Investors, Incubators and Accelerators, Mentors, and Government and Industry Organizations."}},
        {"@type": "Question", "name": "Is it free to join?", "acceptedAnswer": {"@type": "Answer", "text": "Yes. Basic registration is free."}},
        {"@type": "Question", "name": "How do startups benefit?", "acceptedAnswer": {"@type": "Answer", "text": "Startups gain access to funding opportunities, mentorship, incubation programs, government grants, and industry networks."}},
        {"@type": "Question", "name": "How do investors find startups?", "acceptedAnswer": {"@type": "Answer", "text": "Investors can browse startup profiles filtered by sector, stage, and location."}},
        {"@type": "Question", "name": "Can government bodies join the platform?", "acceptedAnswer": {"@type": "Answer", "text": "Yes. Government organizations and industry chambers can join to promote their programs and connect with startups."}}
    ]
}
@endverbatim
</script>
@endsection
@section('content')

<!-- HERO -->
<section class="hero-bg text-white py-20 px-6 text-center">
    <div class="max-w-3xl mx-auto">
        <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full mb-5 border border-white/20 bg-white/10">Got Questions?</span>
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 leading-tight">
            Frequently Asked <span style="color:#57BD68;">Questions</span>
        </h1>
        <p class="text-gray-300 text-base">Everything you need to know about the platform.</p>
    </div>
</section>

<!-- FAQ ACCORDION -->
<section class="py-20 px-6" style="background:var(--bg);">
    <div class="max-w-3xl mx-auto space-y-3">
        @foreach([
            ['#57BD68', 'What is this platform?',
             'This platform connects startups with investors, incubators, government programs, and industry mentors to support the growth of innovative businesses.'],
            ['#1F3C88', 'Who can join this platform?',
             'The platform is open to Startups, Investors, Incubators and Accelerators, Mentors, and Government and Industry Organizations.'],
            ['#FF8C42', 'Is it free to join?',
             'Yes. Basic registration is free. Additional services and programs may be introduced in the future.'],
            ['#2F8F46', 'How do startups benefit?',
             'Startups gain access to funding opportunities, mentorship, incubation programs, government grants, and industry networks.'],
            ['#1F3C88', 'How do investors find startups?',
             'Investors can browse startup profiles filtered by sector, stage, and location. They can also receive curated recommendations based on their investment preferences.'],
            ['#57BD68', 'Can government bodies join the platform?',
             'Yes. Government organizations and industry chambers can join to promote their programs, connect with startups, and support ecosystem development.'],
            ['#FF8C42', 'How is my data protected?',
             'We take data privacy seriously. All user data is encrypted and stored securely. We never share your personal information with third parties without your consent.'],
            ['#1F3C88', 'Can I update my profile after registration?',
             'Yes. You can update your profile, add new information, and manage your connections at any time from your dashboard.'],
        ] as $i => [$color, $question, $answer])
        <div class="card bg-white overflow-hidden">
            <button onclick="toggleFaq({{ $i }})" class="w-full flex items-center justify-between text-left gap-4 px-6 py-4">
                <div class="flex items-center gap-3">
                    <span class="w-1.5 h-1.5 rounded-full shrink-0" style="background:{{ $color }};"></span>
                    <span class="font-semibold text-sm" style="color:var(--text);">{{ $question }}</span>
                </div>
                <span id="faq-icon-{{ $i }}" class="text-lg font-light shrink-0 text-gray-400">+</span>
            </button>
            <div id="faq-body-{{ $i }}" class="hidden px-6 pb-5">
                <div class="h-px bg-gray-100 mb-4"></div>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $answer }}</p>
            </div>
        </div>
        @endforeach
    </div>
</section>

<script>
function toggleFaq(i) {
    const body = document.getElementById('faq-body-' + i);
    const icon = document.getElementById('faq-icon-' + i);
    const isHidden = body.classList.contains('hidden');
    body.classList.toggle('hidden');
    icon.textContent = isHidden ? '−' : '+';
}
</script>

<!-- STILL HAVE QUESTIONS -->
<section class="py-16 px-6 bg-white">
    <div class="max-w-3xl mx-auto">
        <div class="card p-10 text-center" style="background:#0d1b2a; border-color:#1e293b;">
            <h2 class="text-xl font-bold text-white mb-2">Still Have Questions?</h2>
            <p class="text-gray-400 mb-6 text-sm">Our team is happy to help. Reach out and we'll get back to you within 24 hours.</p>
            <div class="flex flex-wrap justify-center gap-3">
                <a href="/contact" class="btn-green font-semibold px-7 py-2.5 rounded-lg text-sm">Contact Us →</a>
                <a href="/join"    class="btn-navy font-semibold px-7 py-2.5 rounded-lg text-sm">Get Started Free</a>
            </div>
        </div>
    </div>
</section>

@endsection
