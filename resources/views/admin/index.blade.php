<x-admin-layout>
    <main class="p-6 space-y-10 bg-gray-50 min-h-screen">

        {{-- Dashboard Header --}}
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Admin Dashboard</h1>
            <a href="{{ route('admin.items.create') }}"
               class="inline-flex items-center gap-2 bg-blue-700 text-white text-sm px-4 py-2 rounded-md hover:bg-blue-800 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4v16m8-8H4" />
                </svg>
                Create Submission
            </a>
        </div>

        {{-- Dashboard Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                <h3 class="text-sm font-semibold text-gray-500 uppercase">Total Submissions</h3>
                <p class="text-3xl text-blue-700 font-bold mt-2">{{ $total ?? 0 }}</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                <h3 class="text-sm font-semibold text-gray-500 uppercase">Approved</h3>
                <p class="text-3xl text-green-600 font-bold mt-2">{{ $approved ?? 0 }}</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                <h3 class="text-sm font-semibold text-gray-500 uppercase">Pending</h3>
                <p class="text-3xl text-yellow-500 font-bold mt-2">{{ $pending ?? 0 }}</p>
            </div>
        </div>

        {{-- Pending Submissions --}}
        <section>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Pending Submissions</h2>

                <a href="{{ route('admin.submissions') }}"
                   class="text-sm text-blue-700 hover:text-blue-900 font-medium transition">
                    View All →
                </a>
            </div>

            <div class="bg-white shadow-sm rounded-lg border border-gray-100 overflow-hidden">
                <table class="w-full text-sm text-gray-700">
                    <thead class="bg-blue-900 text-white text-xs uppercase">
                        <tr>
                            <th class="px-5 py-3 text-left">Title</th>
                            <th class="px-5 py-3 text-left">Submitted By</th>
                            <th class="px-5 py-3 text-left">Type</th>
                            <th class="px-5 py-3 text-left">Year</th>
                            <th class="px-5 py-3 text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($pendingItems as $item)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="px-5 py-3 font-medium text-gray-900">
                                    <a href="{{ route('items.show', $item->id) }}" target="_blank"
                                       class="hover:underline">
                                        {{ Str::limit($item->title, 40) }}
                                    </a>
                                </td>

                                <td class="px-5 py-3">
                                    {{ $item->user->name ?? 'N/A' }}
                                    <div class="text-xs text-gray-400">
                                        {{ $item->user->email ?? '' }}
                                    </div>
                                </td>

                                <td class="px-5 py-3 capitalize">
                                    {{ str_replace('_', ' ', $item->type) }}
                                </td>

                                <td class="px-5 py-3">{{ $item->year ?? '—' }}</td>

                                <td class="px-5 py-3 text-center">
                                    <form action="{{ route('admin.approve', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700 transition">
                                            Approve
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-6 text-center text-gray-500">
                                    No pending submissions.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

    </main>
</x-admin-layout>
