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
                        Verify Your <br class="hidden lg:block">
                        <span class="text-blue-200">Email Address.</span>
                    </h2>

                    <p class="text-sm lg:text-base text-blue-100 max-w-xl">
                        A verification link has been sent to your email. Please check your inbox and confirm your account
                        to start exploring and contributing to the Faculty Repository.
                    </p>

                    <a href="{{ route('home') }}"
                       class="inline-block bg-white text-blue-800 px-5 py-2 rounded-full font-medium hover:bg-blue-100 transition">
                        Back to Home
                    </a>
                </div>

                {{-- Right Side: Verification Card --}}
                <div class="w-full">
                    <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-xl p-8 border border-white/40">
                        <h3 class="text-2xl font-bold text-gray-800 text-center mb-1">Email Verification</h3>
                        <p class="text-sm text-gray-500 text-center mb-6">
                            Confirm your account to continue
                        </p>

                        {{-- Status Message --}}
                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 font-medium text-sm text-green-600 text-center">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        <div class="space-y-5">
                            {{-- Resend Verification Link --}}
                            <form method="POST" action="{{ route('verification.send') }}" class="space-y-3">
                                @csrf
                                <button type="submit"
                                        class="w-full bg-blue-700 text-white py-2 rounded-lg font-semibold hover:bg-blue-800 transition">
                                    Resend Verification Email
                                </button>
                            </form>

                            {{-- Logout --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full text-blue-700 font-semibold hover:underline">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
