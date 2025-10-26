<x-guest-layout>
    <section class="relative overflow-hidden">
        {{-- Background Image --}}
        <div class="absolute inset-0 -z-10 bg-cover bg-center"
             style="background-image:url('{{ asset('images/faculty-bg.jpg') }}');"></div>

        {{-- Gradient Overlay --}}
        <div class="absolute inset-0 -z-10 bg-gradient-to-r from-blue-900/80 via-blue-800/60 to-transparent"></div>

        {{-- Main Content --}}
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16 lg:py-24">
            <div class="grid lg:grid-cols-2 gap-10 items-center">
                {{-- Left Side --}}
                <div class="text-white space-y-5">
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/uniport.png') }}" class="h-10 w-10 rounded-full" alt="Logo">
                        <h1 class="text-2xl font-semibold">
                            <span class="text-blue-200"></span> Repository
                        </h1>
                    </div>

                    <h2 class="text-4xl lg:text-5xl font-extrabold leading-tight">
                        Reset Your <br class="hidden lg:block">
                        <span class="text-blue-200">Password.</span>
                    </h2>

                    <p class="text-sm lg:text-base text-blue-100 max-w-xl">
                        Choose a new password to securely regain access to your Faculty Repository account.
                    </p>

                    <a href="{{ route('home') }}"
                       class="inline-block bg-white text-blue-800 px-5 py-2 rounded-full font-medium hover:bg-blue-100 transition">
                        Back to Home
                    </a>
                </div>

                {{-- Right Side: Reset Form --}}
                <div class="w-full">
                    <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-xl p-8 border border-white/40">
                        <h3 class="text-2xl font-bold text-gray-800 text-center mb-1">Set a New Password</h3>
                        <p class="text-sm text-gray-500 text-center mb-6">
                            Enter your email and your new password below
                        </p>

                        <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                            @csrf

                            {{-- Hidden Token --}}
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            {{-- Email --}}
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                <input id="email" type="email" name="email"
                                       value="{{ old('email', $request->email) }}"
                                       required autofocus autocomplete="username"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                                @error('email')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- New Password --}}
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                <input id="password" type="password" name="password" required autocomplete="new-password"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                                @error('password')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Confirm Password --}}
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                                @error('password_confirmation')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Submit --}}
                            <button type="submit"
                                    class="w-full bg-blue-700 text-white py-2 rounded-lg font-semibold hover:bg-blue-800 transition">
                                Reset Password
                            </button>

                            {{-- Back to Login --}}
                            <p class="text-sm text-center text-gray-600 mt-4">
                                Remembered your password?
                                <a href="{{ route('login') }}" class="text-blue-700 hover:text-blue-900 font-semibold">
                                    Log in
                                </a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
