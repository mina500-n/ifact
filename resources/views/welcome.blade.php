<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>iFact — AI Fake News Detection</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:300,400,500,600,700,800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        .gradient-hero {
            background: radial-gradient(circle at top right, #6366f1 0%, #4f46e5 50%, #4338ca 100%);
        }
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .blob {
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(79, 70, 229, 0.12);
            filter: blur(80px);
            border-radius: 50%;
            pointer-events: none;
        }
        .member-id { font-family: 'Courier New', monospace; }
        .animate-bar {
            animation: grow 2s ease-in-out infinite alternate;
        }
        @keyframes grow {
            from { width: 30%; }
            to   { width: 90%; }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased overflow-x-hidden">

    <!-- Navbar -->
    <nav class="bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-xl">i</span>
                </div>
                <span class="text-slate-900 font-extrabold text-2xl tracking-tight">Fact</span>
            </div>

            <div class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600">
                <a href="#features"    class="hover:text-indigo-600 transition">Features</a>
                <a href="#how-it-works" class="hover:text-indigo-600 transition">Process</a>
                <a href="#team"        class="hover:text-indigo-600 transition">Team</a>
            </div>

            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="text-sm font-semibold text-slate-600 hover:text-indigo-600 transition">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="text-sm font-semibold text-slate-600 hover:text-indigo-600 transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                       class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold px-6 py-2.5 rounded-full shadow-lg shadow-indigo-200 transition-all hover:scale-105">
                        Get Started
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="relative pt-20 pb-32 overflow-hidden">
        <div class="blob top-0 left-0"></div>
        <div class="blob bottom-0 right-0"></div>

        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="inline-flex items-center gap-2 bg-indigo-50 border border-indigo-100 text-indigo-700 text-xs font-bold px-4 py-2 rounded-full mb-8 uppercase tracking-wider">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-600"></span>
                </span>
                Powered by RoBERTa Transformer
            </div>

            <h1 class="text-5xl md:text-7xl font-black text-slate-900 leading-tight mb-8 tracking-tight">
                Weaponize Truth <br/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">
                    Against Disinformation
                </span>
            </h1>

            <p class="text-slate-500 text-lg md:text-xl mb-12 max-w-3xl mx-auto leading-relaxed font-medium">
                Our AI-driven engine analyzes neural patterns in text to identify propaganda,
                detect hallucinated facts, and safeguard your digital reality in real-time.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('register') }}"
                   class="w-full sm:w-auto bg-slate-900 text-white font-bold px-10 py-5 rounded-2xl hover:bg-slate-800 transition shadow-xl shadow-slate-200 flex items-center justify-center gap-2">
                    Try Deep Analysis
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
                <a href="#how-it-works"
                   class="w-full sm:w-auto border-2 border-slate-200 text-slate-700 font-bold px-10 py-5 rounded-2xl hover:bg-slate-50 transition">
                    View Methodology
                </a>
            </div>
        </div>
    </section>

    <!-- Demo Card -->
    <section class="max-w-5xl mx-auto px-6 -mt-16 relative z-10">
        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-indigo-100 border border-slate-100 p-2">
            <div class="bg-slate-50 rounded-[2rem] p-8">
                <div class="flex items-center gap-2 mb-6">
                    <div class="flex gap-1.5">
                        <div class="w-3 h-3 rounded-full bg-red-400"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                        <div class="w-3 h-3 rounded-full bg-green-400"></div>
                    </div>
                    <div class="ml-4 bg-white px-4 py-1.5 rounded-full text-[10px] font-bold text-slate-400 border border-slate-200 uppercase tracking-widest">
                        Neural Network Visualizer
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4">How AI sees the news</h3>
                        <p class="text-slate-500 text-sm mb-6 leading-relaxed">
                            iFact does not just check facts — it checks the
                            <strong>linguistic intent</strong> and <strong>bias patterns</strong>
                            common in fabricated media.
                        </p>
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between text-xs text-slate-400 mb-1">
                                    <span>Fake Probability</span><span>85%</span>
                                </div>
                                <div class="h-2 w-full bg-slate-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-indigo-600 animate-bar rounded-full" style="width:85%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-xs text-slate-400 mb-1">
                                    <span>Sentiment Bias</span><span>40%</span>
                                </div>
                                <div class="h-2 w-full bg-slate-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-purple-500 rounded-full" style="width:40%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-xs text-slate-400 mb-1">
                                    <span>Source Reliability</span><span>65%</span>
                                </div>
                                <div class="h-2 w-full bg-slate-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-emerald-400 rounded-full" style="width:65%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-xs font-bold text-red-600 bg-red-50 px-2 py-1 rounded-full">
                                High Risk Alert
                            </span>
                            <span class="text-xs text-slate-400">Scan ID: #8821</span>
                        </div>
                        <p class="text-sm text-slate-700 italic border-l-4 border-red-500 pl-4 mb-6">
                            "...shocking leaks suggest the moon landing was filmed in a basement..."
                        </p>
                        <div class="flex items-end gap-2">
                            <span class="text-4xl font-black text-slate-900">04%</span>
                            <span class="text-sm font-bold text-slate-400 mb-1.5">Credibility Score</span>
                        </div>
                        <div class="mt-3 w-full bg-slate-100 rounded-full h-2">
                            <div class="bg-red-500 h-2 rounded-full" style="width:4%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Bar -->
    <section class="py-20 px-6">
        <div class="max-w-5xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            @foreach ([
                ['value' => '95%',  'label' => 'Detection Accuracy'],
                ['value' => '< 3s', 'label' => 'Analysis Speed'],
                ['value' => '2',    'label' => 'AI Models'],
                ['value' => '100%', 'label' => 'Free to Use'],
            ] as $stat)
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                    <p class="text-3xl font-extrabold text-indigo-600 mb-1">{{ $stat['value'] }}</p>
                    <p class="text-slate-400 text-sm font-medium">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-20 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-20">
                <h2 class="text-4xl font-black text-slate-900 mb-4 tracking-tight">
                    Beyond Simple Fact-Checking
                </h2>
                <p class="text-slate-500 max-w-2xl mx-auto font-medium">
                    A unified intelligence platform designed to restore digital trust.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ([
                    [
                        'icon'  => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                        'title' => 'Fake News Detection',
                        'desc'  => 'RoBERTa transformer model classifies news as real, fake, or uncertain with high confidence.',
                        'color' => 'bg-indigo-50 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white',
                    ],
                    [
                        'icon'  => 'M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                        'title' => 'Sentiment Analysis',
                        'desc'  => 'Detects emotional manipulation — positive, negative, or neutral tone in any article.',
                        'color' => 'bg-purple-50 text-purple-600 group-hover:bg-purple-600 group-hover:text-white',
                    ],
                    [
                        'icon'  => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                        'title' => 'Credibility Score',
                        'desc'  => 'Every article receives a 0–100 credibility score with a clear visual confidence bar.',
                        'color' => 'bg-green-50 text-green-600 group-hover:bg-green-600 group-hover:text-white',
                    ],
                    [
                        'icon'  => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                        'title' => 'History Tracking',
                        'desc'  => 'All your past analyses are saved and accessible in your personal history log.',
                        'color' => 'bg-yellow-50 text-yellow-600 group-hover:bg-yellow-600 group-hover:text-white',
                    ],
                    [
                        'icon'  => 'M13 10V3L4 14h7v7l9-11h-7z',
                        'title' => 'Instant Results',
                        'desc'  => 'Get AI-powered results in under 3 seconds — no waiting, no delays.',
                        'color' => 'bg-red-50 text-red-500 group-hover:bg-red-500 group-hover:text-white',
                    ],
                    [
                        'icon'  => 'M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1',
                        'title' => 'URL Scraping',
                        'desc'  => 'Paste any news URL and iFact automatically fetches and analyzes the article.',
                        'color' => 'bg-blue-50 text-blue-600 group-hover:bg-blue-600 group-hover:text-white',
                    ],
                ] as $feature)
                    <div class="bg-white p-8 rounded-[2rem] border border-slate-100 card-hover group">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-6 transition-colors duration-300 {{ $feature['color'] }}">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="{{ $feature['icon'] }}"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-extrabold text-slate-900 mb-3">{{ $feature['title'] }}</h3>
                        <p class="text-slate-500 leading-relaxed text-sm">{{ $feature['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-20 px-6">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl font-black text-slate-900 mb-4 tracking-tight">How It Works</h2>
            <p class="text-slate-500 mb-16 font-medium">Three steps to verify any news article.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ([
                    ['step' => '1', 'title' => 'Submit News',   'desc' => 'Paste news text or a URL into the submission form.', 'color' => 'bg-indigo-600'],
                    ['step' => '2', 'title' => 'AI Analyzes',   'desc' => 'Our transformer models process the content instantly.', 'color' => 'bg-purple-600'],
                    ['step' => '3', 'title' => 'Get Results',   'desc' => 'Receive credibility score, verdict, and sentiment.', 'color' => 'bg-indigo-800'],
                ] as $step)
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 rounded-2xl {{ $step['color'] }} text-white flex items-center justify-center text-2xl font-black mb-5 shadow-lg">
                            {{ $step['step'] }}
                        </div>
                        <h3 class="font-bold text-slate-900 mb-2 text-lg">{{ $step['title'] }}</h3>
                        <p class="text-slate-400 text-sm leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

<!-- Team Section -->
<section id="team" class="py-32 px-6 bg-slate-900 relative overflow-hidden">
    <!-- Grid background -->
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <defs>
                <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                    <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.1"/>
                </pattern>
            </defs>
            <rect width="100" height="100" fill="url(#grid)"/>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto relative z-10">
        <div class="text-center mb-16">
            <p class="text-indigo-400 font-bold text-sm uppercase tracking-widest mb-4">
                The Brains Behind iFact
            </p>
            <h3 class="text-4xl md:text-5xl font-black text-white mb-6 tracking-tight">
                Our Development Team
            </h3>
            <p class="text-slate-400 text-lg">
                A multidisciplinary team dedicated to building a more truthful web.
            </p>
        </div>

        <!-- Project Supervisor Card -->
        <div class="flex justify-center mb-16">
            <div class="bg-gradient-to-br from-indigo-600/20 to-purple-600/20 border border-indigo-500/30 rounded-[2rem] p-8 flex flex-col sm:flex-row items-center gap-8 max-w-xl w-full">
                <div class="shrink-0">
                    <div class="w-24 h-24 rounded-2xl overflow-hidden border-2 border-indigo-400/40 shadow-xl shadow-indigo-500/20">
                        <img
                            src="{{ asset('img/dr.nasser.jpeg') }}"
                            alt="Dr. Nasser Tamim"
                            class="w-full h-full object-cover"
                        />
                    </div>
                </div>
                <div>
                    <span class="inline-block text-[10px] font-bold uppercase tracking-widest bg-indigo-500/20 text-indigo-300 px-3 py-1 rounded-full border border-indigo-500/30 mb-3">
                        Project Supervisor
                    </span>
                    <h4 class="text-2xl font-black text-white mb-1">Dr. Nasser Tamim</h4>
                    <p class="text-slate-400 text-sm font-medium">Faculty of IT & CS</p>
                    <div class="mt-4 h-1 w-full bg-white/5 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-indigo-500 to-purple-500 w-3/4 rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Members Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ([
                ['name' => 'Youssef Wael Nabil',    'id' => '202305956', 'role' => ''],
                ['name' => 'Mina Nadi Attia',        'id' => '202304591', 'role' => ''],
                ['name' => 'Moamen Mohamed Elsayed', 'id' => '202304690', 'role' => ''],
                ['name' => 'Ahmed Megahed Mohammed', 'id' => '202305957', 'role' => ''],
                ['name' => 'Luke Elkommos Ghobrial', 'id' => '202304499', 'role' => ''],
                ['name' => 'Mohamed Khaled Sabry',   'id' => '202304511', 'role' => ''],
            ] as $member)
                <div class="group bg-white/5 hover:bg-white/10 border border-white/10 p-8 rounded-[2rem] transition-all duration-300">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-500/20 group-hover:scale-110 transition-transform">
                            <span class="text-white font-bold text-xl">
                                {{ substr($member['name'], 0, 1) }}
                            </span>
                        </div>
                        <span class="member-id text-[10px] bg-indigo-500/20 text-indigo-300 px-3 py-1 rounded-full border border-indigo-500/30">
                            ID: {{ $member['id'] }}
                        </span>
                    </div>
                    <h4 class="text-lg font-bold text-white mb-1 group-hover:text-indigo-400 transition-colors">
                        {{ $member['name'] }}
                    </h4>
                    <p class="text-slate-500 text-sm font-medium mb-6">{{ $member['role'] }}</p>
                    <div class="h-1 w-full bg-white/5 rounded-full overflow-hidden">
                        <div class="h-full bg-indigo-500 w-0 group-hover:w-full transition-all duration-700 rounded-full"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
    <!-- CTA -->
    <section class="py-32 px-6">
        <div class="max-w-5xl mx-auto bg-indigo-600 rounded-[3rem] p-12 md:p-24 text-center relative overflow-hidden shadow-2xl shadow-indigo-200">
            <div class="absolute -top-24 -left-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>

            <h2 class="text-4xl md:text-5xl font-black text-white mb-6 relative z-10">
                Stop the Viral Lies Today.
            </h2>
            <p class="text-indigo-100 text-lg mb-12 max-w-2xl mx-auto relative z-10">
                Join researchers and journalists using iFact to clean up the digital information space.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center relative z-10">
                <a href="{{ route('register') }}"
                   class="bg-white text-indigo-600 font-black px-12 py-5 rounded-2xl hover:scale-105 transition shadow-xl">
                    Get Started Free
                </a>
                <a href="{{ route('login') }}"
                   class="bg-indigo-700 text-white font-bold px-12 py-5 rounded-2xl border border-indigo-400/30 hover:bg-indigo-800 transition">
                    Login
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-100 py-16 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-6 h-6 bg-indigo-600 rounded flex items-center justify-center">
                        <span class="text-white font-bold text-sm">i</span>
                    </div>
                    <span class="text-slate-900 font-extrabold text-xl">Fact</span>
                </div>
                <p class="text-slate-500 text-sm max-w-xs leading-relaxed mb-8">
                    Advancing the frontier of digital truth through deep learning and NLP forensics.
                </p>
            </div>
            <div>
                <h5 class="text-slate-900 font-bold mb-6 text-sm uppercase tracking-widest">Navigation</h5>
                <ul class="space-y-4 text-sm text-slate-500 font-medium">
                    <li><a href="{{ route('dashboard') }}" class="hover:text-indigo-600 transition">Dashboard</a></li>
                    <li><a href="{{ route('news.create') }}" class="hover:text-indigo-600 transition">Submit News</a></li>
                    <li><a href="{{ route('news.history') }}" class="hover:text-indigo-600 transition">History</a></li>
                </ul>
            </div>
            <div>
                <h5 class="text-slate-900 font-bold mb-6 text-sm uppercase tracking-widest">Account</h5>
                <ul class="space-y-4 text-sm text-slate-500 font-medium">
                    <li><a href="{{ route('login') }}" class="hover:text-indigo-600 transition">Login</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-indigo-600 transition">Register</a></li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto border-t border-slate-100 mt-16 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-slate-400 text-xs font-medium">
                &copy; {{ date('Y') }} iFact. Built with Laravel + Python AI.
            </p>
            <div class="flex items-center gap-2 mt-4 md:mt-0">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">
                    System Status: Optimal
                </span>
            </div>
        </div>
    </footer>

</body>
</html>
