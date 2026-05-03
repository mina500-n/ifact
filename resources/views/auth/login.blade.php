<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>iFact — Login</title>
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
<body class="bg-slate-950 min-h-screen flex items-center justify-center px-4 relative overflow-hidden">

    <!-- Background blobs -->
    <div class="blob w-96 h-96 bg-indigo-600/20 -top-20 -left-20"></div>
    <div class="blob w-80 h-80 bg-purple-600/15 bottom-0 right-0"></div>

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
            <h1 class="text-3xl font-black text-white mb-2">Welcome back</h1>
            <p class="text-slate-400 text-sm font-medium">
                Sign in to continue fighting misinformation
            </p>
        </div>

        <!-- Card -->
        <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8 backdrop-blur-sm shadow-2xl">

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 text-green-400 rounded-xl text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-5">
                    <label for="email" class="block text-sm font-semibold text-slate-300 mb-2">
                        Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </div>
                        <input
                            id="email" name="email" type="email"
                            value="{{ old('email') }}"
                            required autofocus autocomplete="username"
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
                            required autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full bg-white/5 border border-white/10 text-white placeholder-slate-500 rounded-xl pl-11 pr-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                        />
                    </div>
                    @error('password')
                        <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember + Forgot -->
                <div class="flex items-center justify-between mb-8">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember"
                               class="w-4 h-4 rounded border-white/20 bg-white/5 text-indigo-600 focus:ring-indigo-500"/>
                        <span class="text-slate-400 text-sm">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-indigo-400 hover:text-indigo-300 text-sm font-medium transition">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-4 rounded-xl transition-all shadow-lg shadow-indigo-500/25 hover:scale-[1.02] flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Sign In
                </button>
            </form>
        </div>

        <!-- Register Link -->
        <p class="text-center text-slate-500 text-sm mt-8">
            Don't have an account?
            <a href="{{ route('register') }}"
               class="text-indigo-400 hover:text-indigo-300 font-semibold transition">
                Create one free
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
