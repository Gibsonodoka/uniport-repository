<x-guest-layout>
    <section class="relative overflow-hidden">
        {{-- Background image --}}
        <div class="absolute inset-0 -z-10 bg-cover bg-center"
             style="background-image:url('{{ asset('images/faculty-bg.jpg') }}');"></div>
        {{-- Dark-to-transparent overlay for readability --}}
        <div class="absolute inset-0 -z-10 bg-gradient-to-r from-blue-900/80 via-blue-800/60 to-transparent"></div>

        {{-- Content container --}}
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16 lg:py-24">
            <div class="grid lg:grid-cols-2 gap-10 items-center">
                {{-- Left: tagline --}}
                <div class="text-white space-y-5">
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/uniport.png') }}" class="h-10 w-10 rounded-full" alt="Logo">
                        <h1 class="text-2xl font-semibold">
                            <span class="text-blue-200"></span> Repository
                        </h1>
                    </div>

                    <h2 class="text-4xl lg:text-5xl font-extrabold leading-tight">
                        Explore Knowledge. <br class="hidden lg:block">
                        <span class="text-blue-200">Preserve History.</span>
                    </h2>

                    <p class="text-sm lg:text-base text-blue-100 max-w-xl">
                        Access and contribute to student research, faculty publications, and departmental archives — all in one place.
                    </p>

                    <a href="{{ route('home') }}"
                       class="inline-block bg-white text-blue-800 px-5 py-2 rounded-full font-medium hover:bg-blue-100 transition">
                        Browse Repository
                    </a>
                </div>

                {{-- Right: login card --}}
                <div class="w-full">
                    <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-xl p-8 border border-white/40">
                        <h3 class="text-2xl font-bold text-gray-800 text-center">Sign In</h3>
                        <p class="text-sm text-gray-500 text-center mb-6">Access your Faculty Repository account</p>

                        {{-- Session status --}}
                        @if (session('status'))
                            <div class="mb-4 text-green-600 text-sm text-center">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="space-y-5">
                            @csrf

                            {{-- Email --}}
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                                @error('email')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <input id="password" type="password" name="password" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                                @error('password')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Remember / Forgot --}}
                            <div class="flex items-center justify-between text-sm">
                                <label class="inline-flex items-center text-gray-600">
                                    <input type="checkbox" name="remember"
                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2">Remember me</span>
                                </label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-blue-700 hover:text-blue-900 font-medium">
                                        Forgot password?
                                    </a>
                                @endif
                            </div>

                            {{-- Submit --}}
                            <button type="submit"
                                    class="w-full bg-blue-700 text-white py-2 rounded-lg font-semibold hover:bg-blue-800 transition">
                                Sign In
                            </button>

                            {{-- Divider --}}
                            <div class="flex items-center my-3">
                                <hr class="flex-grow border-gray-300">
                                <span class="text-xs text-gray-500 px-3">or</span>
                                <hr class="flex-grow border-gray-300">
                            </div>

                            {{-- Google (placeholder) --}}
                            <a href="#" class="w-full flex items-center justify-center gap-2 border border-gray-300 py-2 rounded-lg text-sm font-medium hover:bg-gray-50">
                                <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-5 h-5">
                                Sign in with Google
                            </a>

                            {{-- Register link --}}
                            <p class="text-sm text-center text-gray-600 mt-4">
                                New here?
                                <a href="{{ route('register') }}" class="text-blue-700 hover:text-blue-900 font-semibold">
                                    Create an account
                                </a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
