<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <style>
        * { font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; }
        .stat-card { transition: all 0.3s cubic-bezier(0.4,0,0.2,1); }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); }
        .glass { background: rgba(255,255,255,0.7); backdrop-filter: blur(10px); }
    </style>

    <div class="min-h-screen bg-slate-50 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Welcome Banner -->
            <div class="relative overflow-hidden rounded-3xl bg-slate-900 p-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                <!-- Background grid -->
                <div class="absolute inset-0 opacity-10 pointer-events-none">
                    <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <defs>
                            <pattern id="dash-grid" width="8" height="8" patternUnits="userSpaceOnUse">
                                <path d="M 8 0 L 0 0 0 8" fill="none" stroke="white" stroke-width="0.3"/>
                            </pattern>
                        </defs>
                        <rect width="100" height="100" fill="url(#dash-grid)"/>
                    </svg>
                </div>
                <!-- Blobs -->
                <div class="absolute -top-10 -right-10 w-48 h-48 bg-indigo-600/30 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-10 left-20 w-36 h-36 bg-purple-600/20 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                        </span>
                        <span class="text-slate-400 text-xs font-semibold uppercase tracking-widest">
                            AI System Online
                        </span>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-black text-white mb-1">
                        Welcome back, {{ Auth::user()->name }}
                    </h3>
                    <p class="text-slate-400 text-sm font-medium">
                        Here is your fake news detection summary.
                    </p>
                </div>

                <a href="{{ route('news.create') }}"
                   class="relative z-10 shrink-0 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-sm px-6 py-3 rounded-2xl transition-all hover:scale-105 shadow-lg shadow-indigo-500/25 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Analyze News
                </a>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @php
                    $cards = [
                        [
                            'label' => 'Total Submissions',
                            'value' => $total,
                            'color' => 'text-indigo-600',
                            'bg'    => 'bg-indigo-50',
                            'icon'  => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                            'ring'  => 'ring-indigo-100',
                        ],
                        [
                            'label' => 'Fake Detected',
                            'value' => $fakeCount,
                            'color' => 'text-red-600',
                            'bg'    => 'bg-red-50',
                            'icon'  => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z',
                            'ring'  => 'ring-red-100',
                        ],
                        [
                            'label' => 'Real Verified',
                            'value' => $realCount,
                            'color' => 'text-emerald-600',
                            'bg'    => 'bg-emerald-50',
                            'icon'  => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                            'ring'  => 'ring-emerald-100',
                        ],
                        [
                            'label' => 'Avg Credibility',
                            'value' => round($avgScore ?? 0) . '%',
                            'color' => 'text-amber-600',
                            'bg'    => 'bg-amber-50',
                            'icon'  => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z',
                            'ring'  => 'ring-amber-100',
                        ],
                    ];
                @endphp

                @foreach ($cards as $card)
                    <div class="stat-card bg-white rounded-2xl shadow-sm ring-1 {{ $card['ring'] }} p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 {{ $card['bg'] }} rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 {{ $card['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $card['icon'] }}"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl font-black {{ $card['color'] }} mb-1">
                            {{ $card['value'] }}
                        </p>
                        <p class="text-slate-400 text-xs font-semibold uppercase tracking-wide">
                            {{ $card['label'] }}
                        </p>
                    </div>
                @endforeach
            </div>

            <!-- Charts Row -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Line Chart -->
                <div class="md:col-span-2 bg-white rounded-2xl shadow-sm ring-1 ring-slate-100 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wide">
                                Submission Activity
                            </h4>
                            <p class="text-slate-400 text-xs mt-0.5">Last 7 days</p>
                        </div>
                        <div class="w-8 h-8 bg-indigo-50 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                            </svg>
                        </div>
                    </div>
                    <canvas id="lineChart" height="120"></canvas>
                </div>

                <!-- Doughnut Chart -->
                <div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-100 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wide">
                                Result Breakdown
                            </h4>
                            <p class="text-slate-400 text-xs mt-0.5">All time</p>
                        </div>
                        <div class="w-8 h-8 bg-purple-50 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                            </svg>
                        </div>
                    </div>
                    <canvas id="doughnutChart" height="180"></canvas>
                    <div class="flex justify-center gap-4 mt-5 text-xs text-slate-500">
                        <span class="flex items-center gap-1.5 font-medium">
                            <span class="w-2.5 h-2.5 rounded-full bg-red-400 inline-block"></span> Fake
                        </span>
                        <span class="flex items-center gap-1.5 font-medium">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 inline-block"></span> Real
                        </span>
                        <span class="flex items-center gap-1.5 font-medium">
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-400 inline-block"></span> Uncertain
                        </span>
                    </div>
                </div>
            </div>

            <!-- Sentiment Chart -->
            <div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-100 p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wide">
                            Sentiment Analysis
                        </h4>
                        <p class="text-slate-400 text-xs mt-0.5">Breakdown of emotional tone</p>
                    </div>
                    <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <canvas id="sentimentChart" height="80"></canvas>
            </div>

            <!-- Recent Submissions -->
            <div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-slate-900 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wide">
                                Recent Submissions
                            </h4>
                            <p class="text-slate-400 text-xs">Your latest analyses</p>
                        </div>
                    </div>
                    <a href="{{ route('news.history') }}"
                       class="flex items-center gap-1 text-indigo-600 hover:text-indigo-800 text-sm font-semibold transition">
                        View All
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                @if ($recent->isEmpty())
                    <div class="p-16 text-center">
                        <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <p class="text-slate-500 font-semibold mb-1">No submissions yet</p>
                        <p class="text-slate-400 text-sm mb-6">Start analyzing news articles with AI</p>
                        <a href="{{ route('news.create') }}"
                           class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold px-6 py-3 rounded-xl transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Analyze First Article
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-100">
                                    <th class="px-6 py-3 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Content</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Result</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Score</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Sentiment</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @foreach ($recent as $check)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="px-6 py-4 text-slate-700 max-w-xs">
                                            <p class="truncate font-medium">{{ Str::limit($check->content, 55) }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                $badge = match($check->result) {
                                                    'fake'      => 'bg-red-100 text-red-700 ring-1 ring-red-200',
                                                    'real'      => 'bg-emerald-100 text-emerald-700 ring-1 ring-emerald-200',
                                                    'uncertain' => 'bg-amber-100 text-amber-700 ring-1 ring-amber-200',
                                                    default     => 'bg-slate-100 text-slate-600 ring-1 ring-slate-200',
                                                };
                                            @endphp
                                            <span class="px-2.5 py-1 rounded-lg text-xs font-bold {{ $badge }}">
                                                {{ ucfirst($check->result) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($check->credibility_score !== null)
                                                <div class="flex items-center gap-2">
                                                    <div class="w-16 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                                        <div class="h-full rounded-full
                                                            {{ $check->credibility_score >= 60 ? 'bg-emerald-500' : ($check->credibility_score >= 40 ? 'bg-amber-500' : 'bg-red-500') }}"
                                                             style="width: {{ $check->credibility_score }}%">
                                                        </div>
                                                    </div>
                                                    <span class="text-slate-600 font-semibold text-xs">{{ $check->credibility_score }}%</span>
                                                </div>
                                            @else
                                                <span class="text-slate-300">—</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                $sentColor = match($check->sentiment) {
                                                    'positive' => 'text-emerald-600',
                                                    'negative' => 'text-red-500',
                                                    default    => 'text-slate-500',
                                                };
                                            @endphp
                                            <span class="capitalize text-xs font-semibold {{ $sentColor }}">
                                                {{ $check->sentiment ?? '—' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-slate-400 text-xs font-medium">
                                            {{ $check->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('news.show', $check->id) }}"
                                               class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-800 text-xs font-bold transition">
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
                @endif
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const days   = @json($last7Days->pluck('date'));
        const counts = @json($last7Days->pluck('count'));
        const fakeCount     = {{ $fakeCount }};
        const realCount     = {{ $realCount }};
        const uncertain     = {{ $uncertain }};
        const sentimentData = @json($sentiments);

        // Line Chart
        new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: days,
                datasets: [{
                    label: 'Submissions',
                    data: counts,
                    borderColor: '#6366f1',
                    backgroundColor: 'rgba(99,102,241,0.08)',
                    borderWidth: 2.5,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#6366f1',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f1f5f9' } },
                    x: { grid: { display: false }, ticks: { color: '#94a3b8' } }
                }
            }
        });

        // Doughnut Chart
        new Chart(document.getElementById('doughnutChart'), {
            type: 'doughnut',
            data: {
                labels: ['Fake', 'Real', 'Uncertain'],
                datasets: [{
                    data: [fakeCount, realCount, uncertain],
                    backgroundColor: ['#f87171', '#4ade80', '#fbbf24'],
                    borderWidth: 0,
                    hoverOffset: 6,
                }]
            },
            options: {
                responsive: true,
                cutout: '72%',
                plugins: { legend: { display: false } }
            }
        });

        // Sentiment Bar Chart
        new Chart(document.getElementById('sentimentChart'), {
            type: 'bar',
            data: {
                labels: ['Positive', 'Neutral', 'Negative'],
                datasets: [{
                    label: 'Count',
                    data: [
                        sentimentData['positive'] ?? 0,
                        sentimentData['neutral']  ?? 0,
                        sentimentData['negative'] ?? 0,
                    ],
                    backgroundColor: ['rgba(74,222,128,0.9)', 'rgba(148,163,184,0.9)', 'rgba(248,113,113,0.9)'],
                    borderRadius: 8,
                    borderWidth: 0,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f1f5f9' } },
                    x: { grid: { display: false }, ticks: { color: '#94a3b8' } }
                }
            }
        });
    </script>

</x-app-layout>
