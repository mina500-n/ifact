@extends('admin.layout')
@section('title', 'Admin Dashboard')

@section('content')

    <!-- Stat Cards -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
        @foreach ([
            ['label' => 'Total Users',       'value' => $totalUsers,       'color' => 'text-indigo-600'],
            ['label' => 'Total Submissions', 'value' => $totalSubmissions, 'color' => 'text-blue-600'],
            ['label' => 'Fake Detected',     'value' => $fakeCount,        'color' => 'text-red-500'],
            ['label' => 'Real Verified',     'value' => $realCount,        'color' => 'text-green-500'],
            ['label' => 'Uncertain',         'value' => $uncertainCount,   'color' => 'text-yellow-500'],
            ['label' => 'Avg Credibility',   'value' => $avgScore . '%',   'color' => 'text-purple-600'],
        ] as $card)
            <div class="bg-white rounded-xl shadow-sm p-5 text-center">
                <p class="text-2xl font-bold {{ $card['color'] }}">{{ $card['value'] }}</p>
                <p class="text-gray-400 text-xs mt-1 uppercase tracking-wide">{{ $card['label'] }}</p>
            </div>
        @endforeach
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <!-- Line Chart -->
        <div class="md:col-span-2 bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-sm font-semibold text-gray-600 uppercase mb-4">
                Submissions — Last 14 Days
            </h3>
            <canvas id="lineChart" height="100"></canvas>
        </div>

        <!-- Doughnut Chart -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-sm font-semibold text-gray-600 uppercase mb-4">
                Result Breakdown
            </h3>
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

    <!-- Bottom Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Top Users -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-sm font-semibold text-gray-600 uppercase">Top Users</h3>
                <a href="{{ route('admin.users') }}"
                   class="text-indigo-500 text-xs hover:underline">View All</a>
            </div>
            <table class="min-w-full text-sm divide-y divide-gray-100">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                    <tr>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Email</th>
                        <th class="px-6 py-3 text-left">Submissions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($topUsers as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-3 font-medium text-gray-800">{{ $user->name }}</td>
                            <td class="px-6 py-3 text-gray-500">{{ $user->email }}</td>
                            <td class="px-6 py-3">
                                <span class="bg-indigo-100 text-indigo-600 text-xs font-bold px-2 py-1 rounded-full">
                                    {{ $user->news_checks_count }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Recent Submissions -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-sm font-semibold text-gray-600 uppercase">Recent Submissions</h3>
                <a href="{{ route('admin.submissions') }}"
                   class="text-indigo-500 text-xs hover:underline">View All</a>
            </div>
            <table class="min-w-full text-sm divide-y divide-gray-100">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                    <tr>
                        <th class="px-6 py-3 text-left">User</th>
                        <th class="px-6 py-3 text-left">Result</th>
                        <th class="px-6 py-3 text-left">Score</th>
                        <th class="px-6 py-3 text-left">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($recentSubmissions as $sub)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-3 text-gray-700">{{ $sub->user->name ?? '—' }}</td>
                            <td class="px-6 py-3">
                                @php
                                    $badge = match($sub->result) {
                                        'fake'      => 'bg-red-100 text-red-600',
                                        'real'      => 'bg-green-100 text-green-600',
                                        'uncertain' => 'bg-yellow-100 text-yellow-600',
                                        default     => 'bg-gray-100 text-gray-500',
                                    };
                                @endphp
                                <span class="px-2 py-1 rounded text-xs font-semibold {{ $badge }}">
                                    {{ ucfirst($sub->result) }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-gray-600">
                                {{ $sub->credibility_score !== null ? $sub->credibility_score . '%' : '—' }}
                            </td>
                            <td class="px-6 py-3 text-gray-400 text-xs">
                                {{ $sub->created_at->format('M d, Y') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const days   = @json($last14Days->pluck('date'));
    const counts = @json($last14Days->pluck('count'));

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
                y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f3f4f6' } },
                x: { grid: { display: false } }
            }
        }
    });

    new Chart(document.getElementById('doughnutChart'), {
        type: 'doughnut',
        data: {
            labels: ['Fake', 'Real', 'Uncertain'],
            datasets: [{
                data: [{{ $fakeCount }}, {{ $realCount }}, {{ $uncertainCount }}],
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
</script>
@endpush
