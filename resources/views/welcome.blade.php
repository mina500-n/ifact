<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>iFact — AI Fake News Detection</title>
    <!-- Tailwind CSS via CDN for preview purposes -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .gradient-hero {
            background: radial-gradient(circle at top right, #6366f1 0%, #4f46e5 50%, #4338ca 100%);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .badge-fake { background:#fee2e2; color:#dc2626; }
        .badge-real { background:#dcfce7; color:#16a34a; }
        .member-id { font-family: 'Courier New', Courier, monospace; }
        .blob {
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(79, 70, 229, 0.15);
            filter: blur(80px);
            border-radius: 50%;
            z-index: -1;
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
                <a href="#features" class="hover:text-indigo-600 transition">Features</a>
                <a href="#how-it-works" class="hover:text-indigo-600 transition">Process</a>
                <a href="#team" class="hover:text-indigo-600 transition">Team</a>
            </div>

            <div class="flex items-center gap-4">
                <a href="#" class="text-sm font-semibold text-slate-600 hover:text-indigo-600 transition">Login</a>
                <a href="#" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold px-6 py-2.5 rounded-full shadow-lg shadow-indigo-200 transition-all hover:scale-105">
                    Get Started
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
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

            <h1 class="text-5xl md:text-7xl font-black text-slate-900 leading-[1.1] mb-8 tracking-tight">
                Weaponize Truth <br/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">Against Disinformation</span>
            </h1>

            <p class="text-slate-500 text-lg md:text-xl mb-12 max-w-3xl mx-auto leading-relaxed font-medium">
                Our AI-driven engine analyzes neural patterns in text to identify propaganda,
                detect hallucinated facts, and safeguard your digital reality in real-time.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <button class="w-full sm:w-auto bg-slate-900 text-white font-bold px-10 py-5 rounded-2xl hover:bg-slate-800 transition shadow-xl shadow-slate-200 flex items-center justify-center gap-2">
                    Try Deep Analysis
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </button>
                <button class="w-full sm:w-auto border-2 border-slate-200 text-slate-700 font-bold px-10 py-5 rounded-2xl hover:bg-slate-50 transition">
                    View Methodology
                </button>
            </div>
        </div>
    </section>

    <!-- Real-time Demo Simulation -->
    <section class="max-w-5xl mx-auto px-6 -mt-16 relative z-10">
        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-indigo-100 border border-slate-100 p-2 overflow-hidden">
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
                        <p class="text-slate-500 text-sm mb-6 leading-relaxed">Paste a snippet of news. iFact doesn't just check facts—it checks the <strong>linguistic intent</strong> and <strong>bias patterns</strong> common in fabricated media.</p>
                        <div class="space-y-4">
                            <div class="h-2 w-full bg-slate-200 rounded-full overflow-hidden">
                                <div class="h-full bg-indigo-600 animate-pulse" style="width: 85%"></div>
                            </div>
                            <div class="h-2 w-full bg-slate-200 rounded-full overflow-hidden">
                                <div class="h-full bg-purple-500" style="width: 40%"></div>
                            </div>
                            <div class="h-2 w-full bg-slate-200 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-400" style="width: 65%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-xs font-bold text-red-600 bg-red-50 px-2 py-1 rounded">High Risk Alert</span>
                            <span class="text-xs text-slate-400">Scan ID: #8821</span>
                        </div>
                        <p class="text-sm text-slate-700 italic border-l-4 border-red-500 pl-4 mb-4">
                            "...shocking leaks suggest the moon landing was filmed in a basement..."
                        </p>
                        <div class="flex items-end gap-2">
                            <span class="text-4xl font-black text-slate-900">04%</span>
                            <span class="text-sm font-bold text-slate-400 mb-1.5">Credibility Score</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-32 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-20">
                <h2 class="text-4xl font-black text-slate-900 mb-4 tracking-tight">Beyond Simple Fact-Checking</h2>
                <p class="text-slate-500 max-w-2xl mx-auto font-medium">A unified intelligence platform designed to restore digital trust.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ([
                    ['icon' => 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z', 't' => 'Linguistic Forensics', 'd' => 'Analyzes syntax and punctuation patterns often found in automated bot content.'],
                    ['icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z', 't' => 'Sentiment Correlation', 'd' => 'Cross-references emotional intensity with factual claims to detect manipulation.'],
                    ['icon' => 'M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9', 't' => 'Cross-Source Mining', 'd' => 'Simultaneously scrapes thousands of trusted nodes to verify breaking news.']
                ] as $f)
                <div class="bg-white p-10 rounded-[2rem] border border-slate-100 card-hover group">
                    <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $f['icon'] }}"/></svg>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-4">{{ $f['t'] }}</h3>
                    <p class="text-slate-500 leading-relaxed text-sm">{{ $f['d'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="py-32 px-6 bg-slate-900 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.1"/></pattern></defs>
                <rect width="100" height="100" fill="url(#grid)"/>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-20">
                <div class="max-w-2xl">
                    <h2 class="text-indigo-400 font-bold text-sm uppercase tracking-widest mb-4">The Brains Behind iFact</h2>
                    <h3 class="text-4xl md:text-5xl font-black text-white mb-6 tracking-tight">Our Expert Development Team</h3>
                    <p class="text-slate-400 text-lg">A multidisciplinary team of engineers dedicated to building a more truthful web.</p>
                </div>
                <div class="mt-8 md:mt-0">
                    <div class="bg-white/5 border border-white/10 px-6 py-4 rounded-2xl inline-block backdrop-blur-sm">
                        <p class="text-white font-bold text-sm mb-1">Project Supervisor</p>
                        <p class="text-indigo-400 font-medium italic">Faculty of Engineering Experts</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ([
                    ['name' => 'Youssef Wael Nabil', 'id' => '202305956'],
                    ['name' => 'Mina Nadi Attia', 'id' => '202304591'],
                    ['name' => 'Moamen Mohamed Elsayed', 'id' => '202304690'],
                    ['name' => 'Ahmed Megahed Mohammed', 'id' => '202305957'],
                    ['name' => 'Luke Elkommos Ghobrial', 'id' => '202304499'],
                    ['name' => 'Mohamed Khaled Sabry', 'id' => '202304511']
                ] as $member)
                <div class="group relative bg-white/5 hover:bg-white/10 border border-white/10 p-8 rounded-[2rem] transition-all duration-300">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-500/20 group-hover:scale-110 transition-transform">
                             <span class="text-white font-bold text-xl">{{ substr($member['name'], 0, 1) }}</span>
                        </div>
                        <span class="member-id text-[10px] bg-indigo-500/20 text-indigo-300 px-3 py-1 rounded-full border border-indigo-500/30">
                            ID: {{ $member['id'] }}
                        </span>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-2 group-hover:text-indigo-400 transition-colors">{{ $member['name'] }}</h4>
                    <p class="text-slate-500 text-sm font-medium mb-6">{{ $member['role'] }}</p>

                    <div class="flex gap-4">
                        <div class="h-1 w-full bg-white/5 rounded-full overflow-hidden">
                            <div class="h-full bg-indigo-500 w-0 group-hover:w-full transition-all duration-700"></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-32 px-6">
        <div class="max-w-5xl mx-auto bg-indigo-600 rounded-[3rem] p-12 md:p-24 text-center relative overflow-hidden shadow-2xl shadow-indigo-200">
            <div class="absolute -top-24 -left-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>

            <h2 class="text-4xl md:text-5xl font-black text-white mb-8 relative z-10">Stop the Viral Lies Today.</h2>
            <p class="text-indigo-100 text-lg mb-12 max-w-2xl mx-auto opacity-90 relative z-10">Join thousands of researchers and journalists using iFact to clean up the digital information space.</p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center relative z-10">
                <a href="#" class="bg-white text-indigo-600 font-black px-12 py-5 rounded-2xl hover:scale-105 transition shadow-xl">Get Started for Free</a>
                <a href="#" class="bg-indigo-700 text-white font-bold px-12 py-5 rounded-2xl border border-indigo-400/30 hover:bg-indigo-800 transition">Contact Enterprise</a>
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
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:text-indigo-600 transition cursor-pointer border border-slate-100">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:text-indigo-600 transition cursor-pointer border border-slate-100">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4s1.791-4 4-4 4 1.791 4 4-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </div>
                </div>
            </div>
            <div>
                <h5 class="text-slate-900 font-bold mb-6 text-sm uppercase tracking-widest">Navigation</h5>
                <ul class="space-y-4 text-sm text-slate-500 font-medium">
                    <li><a href="#" class="hover:text-indigo-600 transition">Dashboard</a></li>
                    <li><a href="#" class="hover:text-indigo-600 transition">API Documentation</a></li>
                    <li><a href="#" class="hover:text-indigo-600 transition">Integrations</a></li>
                    <li><a href="#" class="hover:text-indigo-600 transition">Changelog</a></li>
                </ul>
            </div>
            <div>
                <h5 class="text-slate-900 font-bold mb-6 text-sm uppercase tracking-widest">Support</h5>
                <ul class="space-y-4 text-sm text-slate-500 font-medium">
                    <li><a href="#" class="hover:text-indigo-600 transition">Research Ethics</a></li>
                    <li><a href="#" class="hover:text-indigo-600 transition">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-indigo-600 transition">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-indigo-600 transition">Help Center</a></li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto border-t border-slate-100 mt-16 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-slate-400 text-xs font-medium italic">
                &copy; {{ date('Y') }} iFact. Intelligence provided by Transformer Architectures.
            </p>
            <div class="flex items-center gap-2 mt-4 md:mt-0">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">System Status: Optimal</span>
            </div>
        </div>
    </footer>

</body>
</html>
