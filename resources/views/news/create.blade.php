<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Submit News for Analysis</h2>
    </x-slot>

    <style>
        * { font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; }
        .tab-active { background: white; color: #4f46e5; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
    </style>

    <div class="min-h-screen bg-slate-50 py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Page Header -->
            <div>
                <h1 class="text-2xl font-black text-slate-900">Analyze News Article</h1>
                <p class="text-slate-400 text-sm mt-1">
                    Paste text or fetch from a URL — AI will analyze it instantly
                </p>
            </div>

            <!-- Info Banner -->
            <div class="flex items-start gap-3 bg-indigo-950/40 border border-indigo-800/30 rounded-2xl p-4">
                <div class="w-8 h-8 bg-indigo-500/10 rounded-xl flex items-center justify-center shrink-0 mt-0.5">
                    <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="text-indigo-300 text-sm leading-relaxed">
                    Submit any news article text or URL. Our AI will detect fake news,
                    analyze sentiment, and provide a credibility score in seconds.
                </p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-3xl shadow-sm ring-1 ring-slate-100 p-8">

                @if ($errors->any())
                    <div class="mb-6 flex items-start gap-3 p-4 bg-red-50 border border-red-200 rounded-2xl">
                        <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <ul class="text-red-600 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('news.store') }}" id="newsForm">
                    @csrf

                    <!-- Tab Toggle -->
                    <div class="flex bg-slate-100 rounded-2xl p-1 mb-8 gap-1">
                        <button type="button" id="tabText" onclick="switchTab('text')"
                            class="flex-1 flex items-center justify-center gap-2 py-2.5 text-sm font-semibold rounded-xl transition tab-active">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h7"/>
                            </svg>
                            Paste Text
                        </button>
                        <button type="button" id="tabUrl" onclick="switchTab('url')"
                            class="flex-1 flex items-center justify-center gap-2 py-2.5 text-sm font-semibold rounded-xl transition text-slate-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                            Fetch from URL
                        </button>
                    </div>

                    <!-- Text Panel -->
                    <div id="panelText">
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-slate-700 mb-3">
                                News Content
                                <span class="text-red-400">*</span>
                            </label>
                            <textarea
                                name="content" id="content" rows="8"
                                placeholder="Paste the full news article text here (minimum 20 characters)..."
                                class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-4 text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:bg-white resize-none transition"
                                oninput="updateCount()"
                            >{{ old('content') }}</textarea>
                            <div class="flex justify-between mt-2 px-1">
                                <span class="text-xs text-slate-400">Minimum 20 characters required</span>
                                <span class="text-xs font-semibold text-slate-500" id="charCount">0 characters</span>
                            </div>
                        </div>
                    </div>

                    <!-- URL Panel -->
                    <div id="panelUrl" class="hidden">
                        <div class="mb-5">
                            <label class="block text-sm font-bold text-slate-700 mb-3">
                                Article URL
                                <span class="text-red-400">*</span>
                            </label>
                            <div class="flex gap-3">
                                <div class="relative flex-1">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                        </svg>
                                    </div>
                                    <input type="url" id="scrapeUrl"
                                           placeholder="https://example.com/news-article"
                                           class="w-full border border-slate-200 bg-slate-50 rounded-2xl pl-11 pr-4 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:bg-white transition"/>
                                </div>
                                <button type="button" onclick="fetchUrl()" id="fetchBtn"
                                    class="flex items-center gap-2 bg-slate-900 hover:bg-slate-700 text-white text-sm font-bold px-5 py-4 rounded-2xl transition whitespace-nowrap">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    Fetch
                                </button>
                            </div>
                        </div>

                        <div id="fetchStatus" class="hidden mb-4"></div>

                        <div id="fetchedPreview" class="hidden mb-5">
                            <label class="block text-sm font-bold text-slate-700 mb-3">
                                Fetched Content
                                <span class="text-emerald-500 text-xs font-semibold ml-2 bg-emerald-50 px-2 py-0.5 rounded-full">
                                    Ready
                                </span>
                            </label>
                            <div id="previewBox"
                                 class="bg-slate-50 border border-slate-200 rounded-2xl p-5 text-sm text-slate-600 max-h-48 overflow-y-auto leading-relaxed">
                            </div>
                        </div>
                    </div>

                    <!-- Source URL -->
                    <div class="mb-8">
                        <label class="block text-sm font-bold text-slate-700 mb-3">
                            Source URL
                            <span class="text-slate-400 font-normal text-xs ml-1">optional</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </div>
                            <input type="url" name="source_url" id="sourceUrl"
                                   value="{{ old('source_url') }}"
                                   placeholder="https://example.com/news-article"
                                   class="w-full border border-slate-200 bg-slate-50 rounded-2xl pl-11 pr-4 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:bg-white transition"/>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="flex items-center justify-between pt-2">
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center gap-1.5 text-sm text-slate-400 hover:text-slate-600 font-medium transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Cancel
                        </a>
                        <button type="submit" id="submitBtn"
                            class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-bold px-8 py-4 rounded-2xl transition-all shadow-lg shadow-indigo-500/25 hover:scale-[1.02]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            Analyze Now
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <script>
        function switchTab(tab) {
            const isText = tab === 'text';
            document.getElementById('panelText').classList.toggle('hidden', !isText);
            document.getElementById('panelUrl').classList.toggle('hidden', isText);
            document.getElementById('tabText').className = `flex-1 flex items-center justify-center gap-2 py-2.5 text-sm font-semibold rounded-xl transition ${isText ? 'tab-active' : 'text-slate-500'}`;
            document.getElementById('tabUrl').className  = `flex-1 flex items-center justify-center gap-2 py-2.5 text-sm font-semibold rounded-xl transition ${!isText ? 'tab-active' : 'text-slate-500'}`;
        }

        function updateCount() {
            const len = document.getElementById('content').value.length;
            document.getElementById('charCount').textContent = len + ' characters';
        }

        async function fetchUrl() {
            const url     = document.getElementById('scrapeUrl').value.trim();
            const status  = document.getElementById('fetchStatus');
            const preview = document.getElementById('fetchedPreview');
            const btn     = document.getElementById('fetchBtn');

            if (!url) { showStatus('Please enter a valid URL.', 'error'); return; }

            btn.disabled = true;
            btn.innerHTML = `<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg> Fetching...`;
            status.className = 'hidden mb-4';
            preview.classList.add('hidden');

            try {
                const res  = await fetch('{{ route("scrape.fetch") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ url }),
                });
                const data = await res.json();

                if (data.success) {
                    document.getElementById('content').value  = data.text;
                    document.getElementById('sourceUrl').value = url;
                    document.getElementById('previewBox').textContent = data.text;
                    preview.classList.remove('hidden');
                    showStatus(data.title ? 'Fetched: ' + data.title : 'Article fetched successfully.', 'success');
                } else {
                    showStatus(data.error, 'error');
                }
            } catch (err) {
                showStatus('Network error. Please try again.', 'error');
            } finally {
                btn.disabled = false;
                btn.innerHTML = `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg> Fetch`;
            }
        }

        function showStatus(msg, type) {
            const el = document.getElementById('fetchStatus');
            el.className = type === 'success'
                ? 'mb-4 flex items-center gap-2 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-sm font-medium'
                : 'mb-4 flex items-center gap-2 p-4 bg-red-50 border border-red-200 text-red-600 rounded-2xl text-sm font-medium';
            el.innerHTML = type === 'success'
                ? `<svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>${msg}`
                : `<svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>${msg}`;
        }

        document.getElementById('newsForm').addEventListener('submit', function () {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.innerHTML = `<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg> Analyzing...`;
        });
    </script>

</x-app-layout>
