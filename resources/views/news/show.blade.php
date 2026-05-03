<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Analysis Result</h2>
    </x-slot>

    <style>
        * { font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; }
    </style>

    <div class="min-h-screen bg-slate-50 py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="flex items-center gap-3 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-sm">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @php
                $result = $newsCheck->result;
                $score  = $newsCheck->credibility_score ?? 0;

                $config = match($result) {
                    'fake'  => [
                        'bg'       => 'bg-red-950/30',
                        'border'   => 'border-red-800/30',
                        'text'     => 'text-red-400',
                        'label'    => 'FAKE NEWS DETECTED',
                        'bar'      => 'bg-red-500',
                        'icon'     => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z',
                        'iconbg'   => 'bg-red-500/10',
                        'iconring' => 'ring-red-500/20',
                    ],
                    'real'  => [
                        'bg'       => 'bg-emerald-950/20',
                        'border'   => 'border-emerald-800/30',
                        'text'     => 'text-emerald-400',
                        'label'    => 'LIKELY REAL',
                        'bar'      => 'bg-emerald-500',
                        'icon'     => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                        'iconbg'   => 'bg-emerald-500/10',
                        'iconring' => 'ring-emerald-500/20',
                    ],
                    default => [
                        'bg'       => 'bg-amber-950/20',
                        'border'   => 'border-amber-800/30',
                        'text'     => 'text-amber-400',
                        'label'    => 'UNCERTAIN',
                        'bar'      => 'bg-amber-400',
                        'icon'     => 'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                        'iconbg'   => 'bg-amber-500/10',
                        'iconring' => 'ring-amber-500/20',
                    ],
                };
            @endphp

            <!-- Verdict Card -->
            <div class="rounded-3xl border {{ $config['bg'] }} {{ $config['border'] }} p-8">

                <!-- Header -->
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 {{ $config['iconbg'] }} ring-1 {{ $config['iconring'] }} rounded-2xl flex items-center justify-center">
                            <svg class="w-7 h-7 {{ $config['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $config['icon'] }}"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-widest text-slate-500 mb-1">AI Verdict</p>
                            <p class="text-2xl font-black {{ $config['text'] }}">{{ $config['label'] }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-4xl font-black text-white">{{ $score }}%</p>
                        <p class="text-xs text-slate-500 font-medium mt-1">Credibility</p>
                    </div>
                </div>

                <!-- Score Bar -->
                <div class="mb-8">
                    <div class="w-full bg-white/5 rounded-full h-3 overflow-hidden">
                        <div class="h-full rounded-full {{ $config['bar'] }} transition-all"
                             style="width: {{ $score }}%">
                        </div>
                    </div>
                    <div class="flex justify-between text-xs text-slate-600 mt-2">
                        <span>0% — Definitely Fake</span>
                        <span>100% — Definitely Real</span>
                    </div>
                </div>

                <!-- Stats Row -->
                <div class="grid grid-cols-3 gap-4">
                    @php
                        $stats = [
                            [
                                'label' => 'Sentiment',
                                'value' => ucfirst($newsCheck->sentiment ?? '—'),
                                'icon'  => 'M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                            ],
                            [
                                'label' => 'Confidence',
                                'value' => ($newsCheck->ai_details['confidence'] ?? '—') . '%',
                                'icon'  => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                            ],
                            [
                                'label' => 'Word Count',
                                'value' => $newsCheck->ai_details['word_count'] ?? '—',
                                'icon'  => 'M4 6h16M4 12h16M4 18h7',
                            ],
                        ];
                    @endphp

                    @foreach ($stats as $stat)
                        <div class="bg-white/5 border border-white/5 rounded-2xl p-4 text-center">
                            <div class="w-8 h-8 bg-white/5 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"/>
                                </svg>
                            </div>
                            <p class="text-white font-bold text-lg">{{ $stat['value'] }}</p>
                            <p class="text-slate-500 text-xs font-semibold uppercase tracking-wide mt-1">
                                {{ $stat['label'] }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Submitted Content -->
            <div class="bg-white rounded-3xl shadow-sm ring-1 ring-slate-100 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-slate-100 rounded-xl flex items-center justify-center">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wide">
                        Submitted Content
                    </h3>
                </div>

                <p class="text-slate-600 text-sm leading-relaxed bg-slate-50 border border-slate-100 p-5 rounded-2xl">
                    {{ $newsCheck->content }}
                </p>

                @if ($newsCheck->source_url)
                    <a href="{{ $newsCheck->source_url }}" target="_blank"
                       class="inline-flex items-center gap-2 text-indigo-500 hover:text-indigo-700 text-sm mt-4 transition font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        View Source Article
                    </a>
                @endif

                <p class="text-xs text-slate-400 mt-4 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Analyzed on {{ $newsCheck->created_at->format('F d, Y \a\t H:i') }}
                </p>
            </div>

            <!-- AI Reasoning -->
            @if (!empty($newsCheck->ai_details['reason']))
                <div class="bg-white rounded-3xl shadow-sm ring-1 ring-slate-100 p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-8 h-8 bg-indigo-50 rounded-xl flex items-center justify-center">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wide">AI Reasoning</h3>
                    </div>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        {{ $newsCheck->ai_details['reason'] }}
                    </p>
                </div>
            @endif

            <!-- Actions -->
            <div class="flex items-center justify-between">
                <a href="{{ route('news.history') }}"
                   class="flex items-center gap-2 text-slate-500 hover:text-slate-700 text-sm font-semibold transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to History
                </a>
                <a href="{{ route('news.create') }}"
                   class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-bold px-6 py-3 rounded-2xl transition shadow-lg shadow-indigo-500/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Analyze Another
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
