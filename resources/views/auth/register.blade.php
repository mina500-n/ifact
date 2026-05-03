<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>iFact — Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
<style>
    * { font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; }
            .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
        }
    </style>
</head>
<body class="bg-slate-950 min-h-screen flex items-center justify-center px-4 py-12 relative overflow-hidden">

    <!-- Background blobs -->
    <div class="blob w-96 h-96 bg-indigo-600/20 -top-20 -right-20"></div>
    <div class="blob w-80 h-80 bg-purple-600/15 bottom-0 left-0"></div>

    <!-- Grid overlay -->
    <div class="absolute inset-0 opacity-5 pointer-events-none">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <defs>
                <pattern id="grid" width="5" height="5" patternUnits="userSpaceOnUse">
                    <path d="M 5 0 L 0 0 0 5" fill="none" stroke="white" stroke-width="0.2"/>
                </pattern>
            </defs>
            <rect width="100" height="100" fill="url(#grid)"/>
        </svg>
    </div>

    <div class="relative z-10 w-full max-w-md">

        <!-- Logo -->
        <div class="text-center mb-10">
            <a href="/" class="inline-flex items-center gap-2 mb-6">
                <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/30">
                    <span class="text-white font-black text-xl">i</span>
                </div>
                <span class="text-white font-extrabold text-2xl tracking-tight">Fact</span>
            </a>
            <h1 class="text-3xl font-black text-white mb-2">Create your account</h1>
            <p class="text-slate-400 text-sm font-medium">
                Join iFact and start detecting misinformation today
            </p>
        </div>

        <!-- Stat Pills -->
        <div class="flex justify-center gap-3 mb-8">
            @foreach(['95% Accuracy', 'Free Forever', 'AI Powered'] as $pill)
                <span class="text-[10px] font-bold uppercase tracking-widest bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 px-3 py-1.5 rounded-full">
                    {{ $pill }}
                </span>
            @endforeach
        </div>

        <!-- Card -->
        <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8 backdrop-blur-sm shadow-2xl">

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-5">
                    <label for="name" class="block text-sm font-semibold text-slate-300 mb-2">
                        Full Name
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <input
                            id="name" name="name" type="text"
                            value="{{ old('name') }}"
                            required autofocus autocomplete="name"
                            placeholder="John Doe"
                            class="w-full bg-white/5 border border-white/10 text-white placeholder-slate-500 rounded-xl pl-11 pr-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                        />
                    </div>
                    @error('name')
                        <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-5">
                    <label for="email" class="block text-sm font-semibold text-slate-300 mb-2">
                        Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <input
                            id="email" name="email" type="email"
                            value="{{ old('email') }}"
                            required autocomplete="username"
                            placeholder="you@example.com"
                            class="w-full bg-white/5 border border-white/10 text-white placeholder-slate-500 rounded-xl pl-11 pr-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                        />
                    </div>
                    @error('email')
                        <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-5">
                    <label for="password" class="block text-sm font-semibold text-slate-300 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input
                            id="password" name="password" type="password"
                            required autocomplete="new-password"
                            placeholder="Min. 8 characters"
                            class="w-full bg-white/5 border border-white/10 text-white placeholder-slate-500 rounded-xl pl-11 pr-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                        />
                    </div>
                    @error('password')
                        <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-8">
                    <label for="password_confirmation" class="block text-sm font-semibold text-slate-300 mb-2">
                        Confirm Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <input
                            id="password_confirmation" name="password_confirmation" type="password"
                            required autocomplete="new-password"
                            placeholder="Repeat your password"
                            class="w-full bg-white/5 border border-white/10 text-white placeholder-slate-500 rounded-xl pl-11 pr-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                        />
                    </div>
                    @error('password_confirmation')
                        <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-4 rounded-xl transition-all shadow-lg shadow-indigo-500/25 hover:scale-[1.02] flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    Create Account
                </button>
            </form>
        </div>

        <!-- Login Link -->
        <p class="text-center text-slate-500 text-sm mt-8">
            Already have an account?
            <a href="{{ route('login') }}"
               class="text-indigo-400 hover:text-indigo-300 font-semibold transition">
                Sign in here
            </a>
        </p>

        <!-- Back to home -->
        <div class="text-center mt-4">
            <a href="/" class="text-slate-600 hover:text-slate-400 text-xs transition flex items-center justify-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to home
            </a>
        </div>

    </div>
</body>
</html>
