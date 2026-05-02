<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Welcome Banner -->
            <div class="bg-indigo-600 text-white rounded-xl p-6 flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold mb-1">
                        Welcome back, {{ Auth::user()->name }}
                    </h3>
                    <p class="text-indigo-200 text-sm">
                        Here is your fake news detection summary.
                    </p>
                </div>
                <a href="{{ route('news.create') }}"
                   class="bg-white text-indigo-600 font-semibold text-sm px-5 py-2 rounded-lg hover:bg-indigo-50 transition">
                    + Analyze News
                </a>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @php
                    $cards = [
                        ['label' => 'Total Submissions', 'value' => $total,     'color' => 'text-indigo-600'],
                        ['label' => 'Fake Detected',     'value' => $fakeCount, 'color' => 'text-red-500'],
                        ['label' => 'Real Verified',     'value' => $realCount, 'color' => 'text-green-500'],
                        ['label' => 'Avg Credibility',   'value' => round($avgScore ?? 0) . '%', 'color' => 'text-yellow-500'],
                    ];
                @endphp

                @foreach ($cards as $card)
                    <div class="bg-white rounded-xl shadow-sm p-6 text-center">
                        <p class="text-3xl font-bold {{ $card['color'] }}">
                            {{ $card['value'] }}
                        </p>
                        <p class="text-gray-400 text-xs mt-2 uppercase tracking-wide">
                            {{ $card['label'] }}
                        </p>
                    </div>
                @endforeach
            </div>

            <!-- Charts Row -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Line Chart — Submissions Over 7 Days -->
                <div class="md:col-span-2 bg-white rounded-xl shadow-sm p-6">
                    <h4 class="text-sm font-semibold text-gray-600 uppercase mb-4">
                        Submissions — Last 7 Days
                    </h4>
                    <canvas id="lineChart" height="120"></canvas>
                </div>

                <!-- Doughnut Chart — Result Breakdown -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h4 class="text-sm font-semibold text-gray-600 uppercase mb-4">
                        Result Breakdown
                    </h4>
                    <canvas id="doughnutChart" height="180"></canvas>
                    <div class="flex justify-center gap-4 mt-4 text-xs text-gray-500">
                        <span class="flex items-center gap-1">
                            <span class="w-3 h-3 rounded-full bg-red-400 inline-block"></span> Fake
                        </span>
                        <span class="flex items-center gap-1">
                            <span class="w-3 h-3 rounded-full bg-green-400 inline-block"></span> Real
                        </span>
                        <span class="flex items-center gap-1">
                            <span class="w-3 h-3 rounded-full bg-yellow-400 inline-block"></span> Uncertain
                        </span>
                    </div>
                </div>

            </div>

            <!-- Sentiment Bar Chart -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h4 class="text-sm font-semibold text-gray-600 uppercase mb-4">
                    Sentiment Analysis Breakdown
                </h4>
                <canvas id="sentimentChart" height="80"></canvas>
            </div>

            <!-- Recent Submissions Table -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h4 class="text-sm font-semibold text-gray-600 uppercase">
                        Recent Submissions
                    </h4>
                    <a href="{{ route('news.history') }}"
                       class="text-indigo-500 text-sm hover:underline">
                        View All
                    </a>
                </div>

                @if ($recent->isEmpty())
                    <div class="p-8 text-center text-gray-400 text-sm">
                        No submissions yet.
                        <a href="{{ route('news.create') }}" class="text-indigo-500 hover:underline">
                            Analyze your first article.
                        </a>
                    </div>
                @else
                    <table class="min-w-full text-sm divide-y divide-gray-100">
                        <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                            <tr>
                                <th class="px-6 py-3 text-left">Content Preview</th>
                                <th class="px-6 py-3 text-left">Result</th>
                                <th class="px-6 py-3 text-left">Score</th>
                                <th class="px-6 py-3 text-left">Sentiment</th>
                                <th class="px-6 py-3 text-left">Date</th>
                                <th class="px-6 py-3 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach ($recent as $check)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-gray-700 max-w-xs truncate">
                                        {{ Str::limit($check->content, 55) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $badge = match($check->result) {
                                                'fake'      => 'bg-red-100 text-red-600',
                                                'real'      => 'bg-green-100 text-green-600',
                                                'uncertain' => 'bg-yellow-100 text-yellow-600',
                                                default     => 'bg-gray-100 text-gray-500',
                                            };
                                        @endphp
                                        <span class="px-2 py-1 rounded text-xs font-semibold {{ $badge }}">
                                            {{ ucfirst($check->result) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $check->credibility_score !== null ? $check->credibility_score . '%' : '—' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 capitalize">
                                        {{ $check->sentiment ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-400">
                                        {{ $check->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('news.show', $check->id) }}"
                                           class="text-indigo-500 hover:underline">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // ── Data from Laravel ──────────────────────────
        const days   = @json($last7Days->pluck('date'));
        const counts = @json($last7Days->pluck('count'));

        const fakeCount = {{ $fakeCount }};
        const realCount = {{ $realCount }};
        const uncertain = {{ $uncertain }};

        const sentimentData = @json($sentiments);

        // ── Line Chart ────────────────────────────────
        new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: days,
                datasets: [{
                    label: 'Submissions',
                    data: counts,
                    borderColor: '#6366f1',
                    backgroundColor: 'rgba(99,102,241,0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#6366f1',
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 },
                        grid: { color: '#f3f4f6' }
                    },
                    x: { grid: { display: false } }
                }
            }
        });

        // ── Doughnut Chart ────────────────────────────
        new Chart(document.getElementById('doughnutChart'), {
            type: 'doughnut',
            data: {
                labels: ['Fake', 'Real', 'Uncertain'],
                datasets: [{
                    data: [fakeCount, realCount, uncertain],
                    backgroundColor: ['#f87171', '#4ade80', '#fbbf24'],
                    borderWidth: 0,
                }]
            },
            options: {
                responsive: true,
                cutout: '70%',
                plugins: { legend: { display: false } }
            }
        });

        // ── Sentiment Bar Chart ───────────────────────
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
                    backgroundColor: ['#4ade80', '#94a3b8', '#f87171'],
                    borderRadius: 6,
                    borderWidth: 0,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 },
                        grid: { color: '#f3f4f6' }
                    },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>

</x-app-layout>
