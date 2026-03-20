<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In – StartupEco</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .input-field {
            width: 100%; border: 1.5px solid #e5e7eb; border-radius: 10px;
            padding: 11px 16px; font-size: 14px; outline: none; transition: all .2s;
            background: #fafafa; color: #1a1a2e;
        }
        .input-field:focus { border-color: #57BD68; box-shadow: 0 0 0 3px rgba(87,189,104,0.12); background: #fff; }
        .btn-primary {
            width: 100%; background: #57BD68; color: #fff; font-weight: 600;
            padding: 12px; border-radius: 10px; font-size: 14px; border: none;
            cursor: pointer; transition: background .2s; letter-spacing: .01em;
        }
        .btn-primary:hover { background: #2F8F46; }
        .panel { background: linear-gradient(160deg, #0d1b2a 0%, #1F3C88 60%, #0f3318 100%); }
        .alert-error   { background:#fef2f2; border:1px solid #fecaca; color:#dc2626; border-radius:8px; padding:12px 16px; font-size:13px; margin-bottom:16px; }
        .alert-success { background:#edfff1; border:1px solid #A7E4B5; color:#2F8F46;  border-radius:8px; padding:12px 16px; font-size:13px; margin-bottom:16px; }
        .alert-info    { background:#eff6ff; border:1px solid #bfdbfe; color:#1d4ed8;  border-radius:8px; padding:12px 16px; font-size:13px; margin-bottom:16px; }
        .eye-btn { position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#9ca3af; padding:2px; }
        .eye-btn:hover { color:#57BD68; }
        .role-badge { display:inline-flex; align-items:center; gap:6px; background:rgba(87,189,104,0.15); color:#57BD68; border-radius:20px; padding:4px 12px; font-size:12px; font-weight:600; margin:4px; }
    </style>
</head>
<body class="min-h-screen flex" style="background:#F7F9FC;">

<div class="flex w-full min-h-screen">

    <!-- Left Branding Panel -->
    <div class="panel hidden lg:flex lg:w-5/12 xl:w-1/2 flex-col justify-between p-12 relative overflow-hidden">
        <!-- Subtle circles -->
        <div style="position:absolute;width:400px;height:400px;border-radius:50%;border:1px solid rgba(255,255,255,0.05);top:-100px;left:-100px;"></div>
        <div style="position:absolute;width:300px;height:300px;border-radius:50%;border:1px solid rgba(255,255,255,0.05);bottom:50px;right:-80px;"></div>

        <!-- Logo -->
        <a href="/" class="flex items-center gap-2 relative z-10">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:#57BD68;">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <span class="text-xl font-bold text-white">Startup<span style="color:#57BD68;">Eco</span></span>
        </a>

        <!-- Center content -->
        <div class="relative z-10">
            <div class="inline-flex items-center gap-2 mb-6 px-3 py-1.5 rounded-full text-xs font-semibold" style="background:rgba(87,189,104,0.2); color:#57BD68;">
                <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                India's #1 Startup Ecosystem Platform
            </div>
            <h1 class="text-4xl font-bold text-white leading-tight mb-4">
                Welcome back to<br>
                <span style="color:#57BD68;">StartupEco</span>
            </h1>
            <p class="text-gray-400 text-sm leading-relaxed mb-8 max-w-sm">
                Connect with investors, mentors, incubators and government programs. Your startup journey continues here.
            </p>

            <!-- Stats -->
            <div class="grid grid-cols-3 gap-4 mb-8">
                @foreach([['10K+','Members'],['₹500Cr+','Funded'],['200+','Mentors']] as [$num,$label])
                <div class="rounded-xl p-4" style="background:rgba(255,255,255,0.06);">
                    <p class="text-xl font-bold text-white">{{ $num }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $label }}</p>
                </div>
                @endforeach
            </div>

            <!-- Role badges -->
            <div class="flex flex-wrap">
                @foreach(['Startup','Investor','Mentor','Incubator','Government','Industry Expert'] as $r)
                <span class="role-badge">{{ $r }}</span>
                @endforeach
            </div>
        </div>

        <!-- Testimonial -->
        <div class="relative z-10 rounded-2xl p-5" style="background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.08);">
            <p class="text-gray-300 text-sm leading-relaxed mb-3">"StartupEco helped us raise our seed round in just 3 months. The investor network is incredible."</p>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold text-white" style="background:#57BD68;">RK</div>
                <div>
                    <p class="text-white text-xs font-semibold">Rahul Kumar</p>
                    <p class="text-gray-500 text-xs">Founder, TechVenture India</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Form Panel -->
    <div class="flex-1 flex flex-col justify-center items-center px-6 py-12 bg-white">
        <div class="w-full max-w-md">

            <!-- Mobile logo -->
            <a href="/" class="flex items-center gap-2 mb-8 lg:hidden">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#57BD68;">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <span class="text-lg font-bold" style="color:#1a1a2e;">Startup<span style="color:#57BD68;">Eco</span></span>
            </a>

            <h2 class="text-2xl font-bold mb-1" style="color:#1a1a2e;">Sign in to your account</h2>
            <p class="text-gray-500 text-sm mb-7">Don't have an account? <a href="/register" class="font-semibold" style="color:#57BD68;">Create one free →</a></p>

            <!-- Alerts -->
            @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
            @endif
            @if(session('info'))
            <div class="alert-info">{{ session('info') }}</div>
            @endif
            @if($errors->any())
            <div class="alert-error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="/login" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-xs font-semibold mb-1.5" style="color:#374151;">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        placeholder="you@example.com" class="input-field">
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="text-xs font-semibold" style="color:#374151;">Password</label>
                    </div>
                    <div class="relative">
                        <input type="password" name="password" id="password" required
                            placeholder="Your password" class="input-field" style="padding-right:44px;">
                        <button type="button" class="eye-btn" onclick="togglePwd('password','eyeIcon')">
                            <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 text-xs text-gray-500 cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="w-3.5 h-3.5 rounded accent-green-500">
                        Remember me for 30 days
                    </label>
                </div>

                <button type="submit" class="btn-primary">Sign In →</button>
            </form>

            <!-- Divider -->
            <div class="flex items-center gap-3 my-6">
                <div class="flex-1 h-px bg-gray-100"></div>
                <span class="text-xs text-gray-400 font-medium">Demo Credentials</span>
                <div class="flex-1 h-px bg-gray-100"></div>
            </div>

            <!-- Demo credentials quick-fill -->
            <div class="rounded-xl p-4" style="background:#f8fafc; border:1px solid #e5e7eb;">
                <p class="text-xs font-semibold text-gray-500 mb-3">Click to auto-fill demo account:</p>
                <div class="grid grid-cols-2 gap-2">
                    @foreach([
                        ['Super Admin','admin@startupeco.in','Admin@1234','#FF8C42'],
                        ['Startup','startup1@demo.com','Demo@1234','#57BD68'],
                        ['Investor','investor1@demo.com','Demo@1234','#1F3C88'],
                        ['Mentor','mentor1@demo.com','Demo@1234','#0d1b2a'],
                        ['Incubator','incubator1@demo.com','Demo@1234','#57BD68'],
                        ['Gov Body','governmentbody1@demo.com','Demo@1234','#1F3C88'],
                    ] as [$label,$email,$pwd,$color])
                    <button type="button" onclick="fillDemo('{{ $email }}','{{ $pwd }}')"
                        class="text-left rounded-lg px-3 py-2 text-xs font-medium transition-all hover:shadow-sm"
                        style="background:#fff; border:1px solid #e5e7eb; color:{{ $color }};">
                        {{ $label }}
                    </button>
                    @endforeach
                </div>
                <p class="text-xs text-gray-400 mt-2">Password: <span class="font-mono font-semibold">Demo@1234</span> (Admin: <span class="font-mono font-semibold">Admin@1234</span>)</p>
            </div>

            <p class="text-center text-xs text-gray-400 mt-6">
                By signing in you agree to our
                <a href="#" class="underline hover:text-gray-600">Terms</a> &amp;
                <a href="#" class="underline hover:text-gray-600">Privacy Policy</a>
            </p>
        </div>
    </div>
</div>

<script>
function togglePwd(id, iconId) {
    const input = document.getElementById(id);
    input.type = input.type === 'password' ? 'text' : 'password';
}
function fillDemo(email, pwd) {
    document.querySelector('input[name="email"]').value = email;
    document.getElementById('password').value = pwd;
}
</script>
</body>
</html>
