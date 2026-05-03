<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Submission History</h2>
    </x-slot>

    <style>
        * { font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; }
        .row-hover { transition: all 0.15s ease; }
        .row-hover:hover { background: #f8fafc; }
    </style>

    <div class="min-h-screen bg-slate-50 py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Page Header -->
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-black text-slate-900">Submission History</h1>
                    <p class="text-slate-400 text-sm mt-1">All your past AI analyses in one place</p>
                </div>
                <a href="{{ route('news.create') }}"
                   class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-bold px-5 py-3 rounded-xl transition shadow-lg shadow-indigo-500/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    New Analysis
                </a>
            </div>

            <!-- Table Card -->
            <div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-100 overflow-hidden">

                @if ($checks->isEmpty())
                    <div class="py-24 text-center">
                        <div class="w-20 h-20 bg-slate-100 rounded-3xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <p class="text-slate-700 font-bold text-lg mb-2">No submissions yet</p>
                        <p class="text-slate-400 text-sm mb-8">Start verifying news articles with AI</p>
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
                                <tr class="bg-slate-900">
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">#</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Content Preview</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Result</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Score</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Sentiment</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach ($checks as $check)
                                    <tr class="row-hover">
                                        <td class="px-6 py-4">
                                            <span class="text-xs font-bold text-slate-300 bg-slate-100 px-2 py-1 rounded-lg">
                                                #{{ $check->id }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 max-w-xs">
                                            <p class="text-slate-700 font-medium truncate">
                                                {{ Str::limit($check->content, 60) }}
                                            </p>
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                $badge = match($check->result) {
                                                    'fake'      => 'bg-red-100 text-red-700 ring-1 ring-red-200',
                                                    'real'      => 'bg-emerald-100 text-emerald-700 ring-1 ring-emerald-200',
                                                    'pending'   => 'bg-amber-100 text-amber-700 ring-1 ring-amber-200',
                                                    default     => 'bg-slate-100 text-slate-600 ring-1 ring-slate-200',
                                                };
                                                $icon = match($check->result) {
                                                    'fake'    => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z',
                                                    'real'    => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                                                    default   => 'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                                                };
                                            @endphp
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-bold {{ $badge }}">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
                                                </svg>
                                                {{ ucfirst($check->result) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($check->credibility_score !== null)
                                                <div class="flex items-center gap-2">
                                                    <div class="w-16 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                                        <div class="h-full rounded-full
                                                            {{ $check->credibility_score >= 60 ? 'bg-emerald-500' : ($check->credibility_score >= 40 ? 'bg-amber-500' : 'bg-red-500') }}"
                                                             style="width:{{ $check->credibility_score }}%">
                                                        </div>
                                                    </div>
                                                    <span class="text-xs font-bold text-slate-600">{{ $check->credibility_score }}%</span>
                                                </div>
                                            @else
                                                <span class="text-slate-300 text-xs">—</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                $sentColor = match($check->sentiment) {
                                                    'positive' => 'text-emerald-600 bg-emerald-50',
                                                    'negative' => 'text-red-500 bg-red-50',
                                                    'neutral'  => 'text-slate-500 bg-slate-100',
                                                    default    => 'text-slate-300',
                                                };
                                            @endphp
                                            @if($check->sentiment)
                                                <span class="text-xs font-semibold capitalize px-2 py-1 rounded-lg {{ $sentColor }}">
                                                    {{ $check->sentiment }}
                                                </span>
                                            @else
                                                <span class="text-slate-300 text-xs">—</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-col">
                                                <span class="text-xs font-semibold text-slate-600">
                                                    {{ $check->created_at->format('M d, Y') }}
                                                </span>
                                                <span class="text-xs text-slate-400">
                                                    {{ $check->created_at->format('H:i') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('news.show', $check->id) }}"
                                               class="inline-flex items-center gap-1 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 text-xs font-bold px-3 py-1.5 rounded-lg transition">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-slate-100">
                        {{ $checks->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
