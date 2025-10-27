<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Uniport Repository - Admin Panel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex">
        {{-- Sidebar --}}
        <x-admin-sidebar />

        <div class="flex-1 flex flex-col">
            {{-- Navbar --}}
            <x-admin-navbar />

            {{-- Main Content --}}
            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
