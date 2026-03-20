<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account – StartupEco</title>
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
            cursor: pointer; transition: background .2s;
        }
        .btn-primary:hover { background: #2F8F46; }
        .panel { background: linear-gradient(160deg, #0d1b2a 0%, #1F3C88 60%, #0f3318 100%); }
        .alert-error { background:#fef2f2; border:1px solid #fecaca; color:#dc2626; border-radius:8px; padding:12px 16px; font-size:13px; margin-bottom:16px; }
        .role-card {
            border: 1.5px solid #e5e7eb; border-radius: 10px; padding: 10px 12px;
            cursor: pointer; transition: all .2s; display: flex; align-items: center; gap: 8px;
            background: #fafafa; font-size: 13px; font-weight: 500; color: #374151;
        }
        .role-card:hover { border-color: #57BD68; background: #f0fdf4; color: #2F8F46; }
        .role-card.selected { border-color: #57BD68; background: #f0fdf4; color: #2F8F46; box-shadow: 0 0 0 3px rgba(87,189,104,0.12); }
        .role-card .dot { width:8px; height:8px; border-radius:50%; border:2px solid #d1d5db; flex-shrink:0; transition:all .2s; }
        .role-card.selected .dot { background:#57BD68; border-color:#57BD68; }
        .strength-bar { height: 3px; border-radius: 2px; transition: all .3s; }
        .eye-btn { position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#9ca3af; }
        .eye-btn:hover { color:#57BD68; }
        .step-dot { width:8px; height:8px; border-radius:50%; background:rgba(255,255,255,0.2); }
        .step-dot.active { background:#57BD68; }
    </style>
</head>
<body class="min-h-screen flex" style="background:#F7F9FC;">

<div class="flex w-full min-h-screen">

    <!-- Left Branding Panel -->
    <div class="panel hidden lg:flex lg:w-5/12 xl:w-1/2 flex-col justify-between p-12 relative overflow-hidden">
        <div style="position:absolute;width:400px;height:400px;border-radius:50%;border:1px solid rgba(255,255,255,0.05);top:-100px;left:-100px;"></div>
        <div style="position:absolute;width:300px;height:300px;border-radius:50%;border:1px solid rgba(255,255,255,0.05);bottom:50px;right:-80px;"></div>

        <a href="/" class="flex items-center gap-2 relative z-10">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:#57BD68;">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <span class="text-xl font-bold text-white">Startup<span style="color:#57BD68;">Eco</span></span>
        </a>

        <div class="relative z-10">
            <div class="inline-flex items-center gap-2 mb-6 px-3 py-1.5 rounded-full text-xs font-semibold" style="background:rgba(87,189,104,0.2); color:#57BD68;">
                <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                Free to join — No credit card needed
            </div>
            <h1 class="text-4xl font-bold text-white leading-tight mb-4">
                Join India's most<br>
                connected <span style="color:#57BD68;">startup</span><br>
                ecosystem
            </h1>
            <p class="text-gray-400 text-sm leading-relaxed mb-8 max-w-sm">
                Whether you're a founder, investor, mentor or government body — StartupEco has the right tools and network for you.
            </p>

            <!-- Benefits -->
            <div class="space-y-3">
                @foreach([
                    ['Access 500+ verified investors','#57BD68'],
                    ['Apply to government grant programs','#FF8C42'],
                    ['Connect with 200+ expert mentors','#57BD68'],
                    ['Join 50+ incubator programs','#1F3C88'],
                    ['Real-time ecosystem updates','#57BD68'],
                ] as [$benefit,$color])
                <div class="flex items-center gap-3">
                    <div class="w-5 h-5 rounded-full flex items-center justify-center flex-shrink-0" style="background:{{ $color }}20;">
                        <svg class="w-3 h-3" style="color:{{ $color }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-gray-300 text-sm">{{ $benefit }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Social proof -->
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-3">
                <div class="flex -space-x-2">
                    @foreach(['RK','AS','PM','VG','NM'] as $i => $init)
                    <div class="w-8 h-8 rounded-full border-2 border-gray-800 flex items-center justify-center text-xs font-bold text-white"
                         style="background:{{ ['#57BD68','#1F3C88','#FF8C42','#0d1b2a','#57BD68'][$i] }};">{{ $init }}</div>
                    @endforeach
                </div>
                <p class="text-gray-400 text-xs">+10,000 members already joined</p>
            </div>
            <div class="flex gap-1">
                @for($i=0;$i<5;$i++)<svg class="w-4 h-4" style="color:#FF8C42;" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>@endfor
                <span class="text-gray-400 text-xs ml-1">4.9/5 from 2,400+ reviews</span>
            </div>
        </div>
    </div>

    <!-- Right Form Panel -->
    <div class="flex-1 flex flex-col justify-center items-center px-6 py-10 bg-white overflow-y-auto">
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

            <h2 class="text-2xl font-bold mb-1" style="color:#1a1a2e;">Create your free account</h2>
            <p class="text-gray-500 text-sm mb-7">Already have an account? <a href="/login" class="font-semibold" style="color:#57BD68;">Sign in →</a></p>

            @if($errors->any())
            <div class="alert-error">
                <ul class="space-y-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="/register" class="space-y-5" id="regForm">
                @csrf

                <!-- Name + Email -->
                <div class="grid grid-cols-1 gap-5">
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="color:#374151;">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            placeholder="Your full name" class="input-field">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="color:#374151;">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            placeholder="you@example.com" class="input-field">
                    </div>
                </div>

                <!-- Role Selection -->
                <div>
                    <label class="block text-xs font-semibold mb-2" style="color:#374151;">I am joining as a...</label>
                    <input type="hidden" name="role" id="roleInput" value="{{ old('role') }}" required>
                    <div class="grid grid-cols-2 gap-2" id="roleCards">
                        @foreach($roles as $value => $label)
                        <div class="role-card {{ old('role') === $value ? 'selected' : '' }}"
                             onclick="selectRole('{{ $value }}', this)">
                            <span class="dot"></span>
                            <span>{{ $label }}</span>
                        </div>
                        @endforeach
                    </div>
                    @error('role')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-xs font-semibold mb-1.5" style="color:#374151;">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="pwd" required
                            placeholder="Min 8 chars, uppercase + number"
                            class="input-field" style="padding-right:44px;"
                            oninput="checkStrength(this.value)">
                        <button type="button" class="eye-btn" onclick="togglePwd('pwd')">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    <!-- Strength bars -->
                    <div class="flex gap-1 mt-2">
                        <div class="strength-bar flex-1 bg-gray-100" id="s1"></div>
                        <div class="strength-bar flex-1 bg-gray-100" id="s2"></div>
                        <div class="strength-bar flex-1 bg-gray-100" id="s3"></div>
                        <div class="strength-bar flex-1 bg-gray-100" id="s4"></div>
                    </div>
                    <p class="text-xs text-gray-400 mt-1" id="strengthLabel"></p>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-xs font-semibold mb-1.5" style="color:#374151;">Confirm Password</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="pwd2" required
                            placeholder="Repeat your password"
                            class="input-field" style="padding-right:44px;"
                            oninput="checkMatch()">
                        <button type="button" class="eye-btn" onclick="togglePwd('pwd2')">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    <p class="text-xs mt-1" id="matchLabel"></p>
                </div>

                <!-- Terms -->
                <label class="flex items-start gap-2.5 cursor-pointer">
                    <input type="checkbox" required class="mt-0.5 w-3.5 h-3.5 rounded accent-green-500 flex-shrink-0">
                    <span class="text-xs text-gray-500">
                        I agree to the <a href="#" class="underline hover:text-gray-700">Terms of Service</a>
                        and <a href="#" class="underline hover:text-gray-700">Privacy Policy</a>
                    </span>
                </label>

                <button type="submit" class="btn-primary">Create Account →</button>
            </form>

            <p class="text-center text-xs text-gray-400 mt-6">
                Your data is protected with 256-bit SSL encryption
            </p>
        </div>
    </div>
</div>

<script>
function selectRole(value, el) {
    document.querySelectorAll('.role-card').forEach(c => c.classList.remove('selected'));
    el.classList.add('selected');
    document.getElementById('roleInput').value = value;
}

function togglePwd(id) {
    const el = document.getElementById(id);
    el.type = el.type === 'password' ? 'text' : 'password';
}

function checkStrength(val) {
    let score = 0;
    if (val.length >= 8) score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    const colors = ['#ef4444','#FF8C42','#57BD68','#2F8F46'];
    const labels = ['Weak','Fair','Good','Strong'];
    for (let i = 1; i <= 4; i++) {
        const bar = document.getElementById('s' + i);
        bar.style.background = i <= score ? colors[score - 1] : '#e5e7eb';
    }
    document.getElementById('strengthLabel').textContent = val.length ? labels[score - 1] || '' : '';
    document.getElementById('strengthLabel').style.color = score > 0 ? colors[score - 1] : '#9ca3af';
}

function checkMatch() {
    const p1 = document.getElementById('pwd').value;
    const p2 = document.getElementById('pwd2').value;
    const lbl = document.getElementById('matchLabel');
    if (!p2) { lbl.textContent = ''; return; }
    if (p1 === p2) {
        lbl.textContent = '✓ Passwords match';
        lbl.style.color = '#57BD68';
    } else {
        lbl.textContent = '✗ Passwords do not match';
        lbl.style.color = '#ef4444';
    }
}
</script>
</body>
</html>
