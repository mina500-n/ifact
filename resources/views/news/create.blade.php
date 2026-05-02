<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Submit News for Analysis
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <!-- Info Banner -->
            <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-4 mb-6 flex gap-3 items-start">
                <svg class="w-5 h-5 text-indigo-500 mt-0.5 shrink-0" fill="none"
                     stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-indigo-700 text-sm">
                    Paste news text directly <strong>or</strong> enter a URL to automatically
                    fetch the article content for AI analysis.
                </p>
            </div>

            <div class="bg-white shadow-sm rounded-xl p-8">

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <ul class="text-red-600 text-sm list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('news.store') }}" id="newsForm">
                    @csrf

                    <!-- Tab Toggle -->
                    <div class="flex rounded-xl bg-gray-100 p-1 mb-6">
                        <button type="button" id="tabText"
                            onclick="switchTab('text')"
                            class="flex-1 py-2 text-sm font-semibold rounded-lg transition tab-active">
                            Paste Text
                        </button>
                        <button type="button" id="tabUrl"
                            onclick="switchTab('url')"
                            class="flex-1 py-2 text-sm font-semibold rounded-lg transition text-gray-500">
                            Fetch from URL
                        </button>
                    </div>

                    <!-- Text Input Panel -->
                    <div id="panelText">
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                News Content <span class="text-red-500">*</span>
                            </label>
                            <textarea
                                name="content"
                                id="content"
                                rows="8"
                                placeholder="Paste the full news article text here (minimum 20 characters)..."
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 resize-none"
                                oninput="updateCount()"
                            >{{ old('content') }}</textarea>
                            <div class="flex justify-between mt-1">
                                <span class="text-xs text-gray-400">Minimum 20 characters</span>
                                <span class="text-xs text-gray-400" id="charCount">0 characters</span>
                            </div>
                        </div>
                    </div>

                    <!-- URL Fetch Panel -->
                    <div id="panelUrl" class="hidden">
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Article URL <span class="text-red-500">*</span>
                            </label>
                            <div class="flex gap-2">
                                <input
                                    type="url"
                                    id="scrapeUrl"
                                    placeholder="https://example.com/news-article"
                                    class="flex-1 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400"
                                />
                                <button type="button" onclick="fetchUrl()"
                                    id="fetchBtn"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-5 py-3 rounded-xl transition whitespace-nowrap">
                                    Fetch Article
                                </button>
                            </div>
                        </div>

                        <!-- Fetch Status -->
                        <div id="fetchStatus" class="hidden mb-4 p-3 rounded-lg text-sm"></div>

                        <!-- Fetched Preview -->
                        <div id="fetchedPreview" class="hidden mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Fetched Content
                                <span class="text-green-500 text-xs font-normal ml-2">
                                    Ready for analysis
                                </span>
                            </label>
                            <div id="previewBox"
                                 class="bg-gray-50 border border-gray-200 rounded-xl p-4 text-sm text-gray-600 max-h-48 overflow-y-auto leading-relaxed">
                            </div>
                        </div>
                    </div>

                    <!-- Source URL (always visible) -->
                    <div class="mb-8">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Source URL
                            <span class="text-gray-400 font-normal">(optional — for reference)</span>
                        </label>
                        <input
                            type="url"
                            name="source_url"
                            id="sourceUrl"
                            value="{{ old('source_url') }}"
                            placeholder="https://example.com/news-article"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400"
                        />
                    </div>

                    <!-- Submit -->
                    <div class="flex items-center justify-between">
                        <a href="{{ route('dashboard') }}"
                           class="text-sm text-gray-400 hover:text-gray-600 transition">
                            Cancel
                        </a>
                        <button type="submit" id="submitBtn"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-8 py-3 rounded-xl transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Analyze Now
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        // ── Tab Switching ─────────────────────────────
        function switchTab(tab) {
            const isText = tab === 'text';

            document.getElementById('panelText').classList.toggle('hidden', !isText);
            document.getElementById('panelUrl').classList.toggle('hidden',  isText);

            document.getElementById('tabText').classList.toggle('tab-active', isText);
            document.getElementById('tabText').classList.toggle('text-gray-500', !isText);
            document.getElementById('tabUrl').classList.toggle('tab-active', !isText);
            document.getElementById('tabUrl').classList.toggle('text-gray-500', isText);
        }

        // ── Character Counter ─────────────────────────
        function updateCount() {
            const len = document.getElementById('content').value.length;
            document.getElementById('charCount').textContent = len + ' characters';
        }

        // ── URL Fetcher ───────────────────────────────
        async function fetchUrl() {
            const url     = document.getElementById('scrapeUrl').value.trim();
            const status  = document.getElementById('fetchStatus');
            const preview = document.getElementById('fetchedPreview');
            const btn     = document.getElementById('fetchBtn');

            if (!url) {
                showStatus('Please enter a valid URL.', 'error');
                return;
            }

            // Loading state
            btn.disabled    = true;
            btn.textContent = 'Fetching...';
            status.className  = 'hidden mb-4 p-3 rounded-lg text-sm';
            preview.classList.add('hidden');

            try {
                const res = await fetch('{{ route("scrape.fetch") }}', {
                    method:  'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ url }),
                });

                const data = await res.json();

                if (data.success) {
                    // Populate hidden textarea with fetched content
                    document.getElementById('content').value = data.text;
                    document.getElementById('sourceUrl').value = url;

                    // Show preview
                    document.getElementById('previewBox').textContent = data.text;
                    preview.classList.remove('hidden');

                    if (data.title) {
                        showStatus('Article fetched: ' + data.title, 'success');
                    } else {
                        showStatus('Article content fetched successfully.', 'success');
                    }
                } else {
                    showStatus(data.error, 'error');
                }

            } catch (err) {
                showStatus('Network error. Please try again.', 'error');
            } finally {
                btn.disabled    = false;
                btn.textContent = 'Fetch Article';
            }
        }

        function showStatus(message, type) {
            const el = document.getElementById('fetchStatus');
            el.textContent  = message;
            el.className = type === 'success'
                ? 'mb-4 p-3 rounded-lg text-sm bg-green-50 border border-green-200 text-green-700'
                : 'mb-4 p-3 rounded-lg text-sm bg-red-50 border border-red-200 text-red-700';
        }

        // ── Submit Spinner ────────────────────────────
        document.getElementById('newsForm').addEventListener('submit', function () {
            const btn = document.getElementById('submitBtn');
            btn.disabled  = true;
            btn.innerHTML = `
                <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10"
                            stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                </svg>
                Analyzing...
            `;
        });
    </script>

    <style>
        .tab-active {
            background: white;
            color: #4f46e5;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
    </style>

</x-app-layout>
