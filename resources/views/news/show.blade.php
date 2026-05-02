<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Analysis Result
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Verdict Card -->
            @php
                $result = $newsCheck->result;
                $score  = $newsCheck->credibility_score;

                $config = match($result) {
                    'fake'      => ['bg' => 'bg-red-50',     'border' => 'border-red-200',
                                    'text' => 'text-red-700',  'label' => 'FAKE NEWS DETECTED',
                                    'bar'  => 'bg-red-500'],
                    'real'      => ['bg' => 'bg-green-50',   'border' => 'border-green-200',
                                    'text' => 'text-green-700','label' => 'LIKELY REAL',
                                    'bar'  => 'bg-green-500'],
                    default     => ['bg' => 'bg-yellow-50',  'border' => 'border-yellow-200',
                                    'text' => 'text-yellow-700','label' => 'UNCERTAIN',
                                    'bar'  => 'bg-yellow-400'],
                };
            @endphp

            <div class="rounded-lg border p-8 text-center {{ $config['bg'] }} {{ $config['border'] }}">
                <p class="text-2xl font-bold {{ $config['text'] }} mb-4">
                    {{ $config['label'] }}
                </p>

                <!-- Credibility Bar -->
                <div class="mb-2 text-sm text-gray-600 font-medium">
                    Credibility Score: <strong>{{ $score }}%</strong>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-4 mb-6">
                    <div class="h-4 rounded-full transition-all {{ $config['bar'] }}"
                         style="width: {{ $score }}%">
                    </div>
                </div>

                <!-- Stats Row -->
                <div class="grid grid-cols-3 gap-4 text-sm">
                    <div class="bg-white rounded-lg p-3 shadow-sm">
                        <p class="text-gray-400 text-xs uppercase mb-1">Sentiment</p>
                        <p class="font-semibold text-gray-700 capitalize">
                            {{ $newsCheck->sentiment ?? '—' }}
                        </p>
                    </div>
                    <div class="bg-white rounded-lg p-3 shadow-sm">
                        <p class="text-gray-400 text-xs uppercase mb-1">Confidence</p>
                        <p class="font-semibold text-gray-700">
                            {{ $newsCheck->ai_details['confidence'] ?? '—' }}%
                        </p>
                    </div>
                    <div class="bg-white rounded-lg p-3 shadow-sm">
                        <p class="text-gray-400 text-xs uppercase mb-1">Word Count</p>
                        <p class="font-semibold text-gray-700">
                            {{ $newsCheck->ai_details['word_count'] ?? '—' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Submitted Content -->
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-sm font-semibold text-gray-600 uppercase mb-3">
                    Submitted Content
                </h3>
                <p class="text-gray-700 text-sm leading-relaxed bg-gray-50 p-4 rounded-lg">
                    {{ $newsCheck->content }}
                </p>

                @if ($newsCheck->source_url)
                    <p class="text-sm text-indigo-500 mt-3">
                        Source:
                        <a href="{{ $newsCheck->source_url }}"
                           target="_blank" class="underline">
                            {{ $newsCheck->source_url }}
                        </a>
                    </p>
                @endif

                <p class="text-xs text-gray-400 mt-3">
                    Analyzed on {{ $newsCheck->created_at->format('F d, Y \a\t H:i') }}
                </p>
            </div>

            <!-- AI Reason -->
            @if (!empty($newsCheck->ai_details['reason']))
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h3 class="text-sm font-semibold text-gray-600 uppercase mb-2">
                        AI Reasoning
                    </h3>
                    <p class="text-gray-600 text-sm">
                        {{ $newsCheck->ai_details['reason'] }}
                    </p>
                </div>
            @endif

            <!-- Actions -->
            <div class="flex justify-between text-sm">
                <a href="{{ route('news.history') }}"
                   class="text-gray-500 hover:text-gray-700">
                    &larr; Back to History
                </a>
                <a href="{{ route('news.create') }}"
                   class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg transition">
                    Analyze Another
                </a>
            </div>

        </div>
    </div>
</x-app-layout>