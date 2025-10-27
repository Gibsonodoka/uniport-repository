<x-user-layout>
    <main class="p-6 space-y-10 bg-gray-50 min-h-screen">

        {{-- Dashboard Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Total Submissions</h3>
                <p class="text-3xl text-blue-700 font-bold mt-2">{{ $totalSubmissions ?? 0 }}</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Approved Works</h3>
                <p class="text-3xl text-green-600 font-bold mt-2">{{ $approved ?? 0 }}</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Pending Approvals</h3>
                <p class="text-3xl text-yellow-500 font-bold mt-2">{{ $pending ?? 0 }}</p>
            </div>
        </div>

        {{-- Recent Submissions --}}
        <section>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Recent Submissions</h2>

                <a href="{{ route('items.create') }}"
                   class="bg-blue-700 text-white text-sm px-4 py-2 rounded-md hover:bg-blue-800 transition">
                    + Submit New Work
                </a>
            </div>

            <div class="bg-white shadow-sm rounded-lg border border-gray-100 overflow-hidden">
                <table class="w-full text-sm text-gray-700">
                    <thead class="bg-blue-900 text-white text-xs uppercase">
                        <tr>
                            <th class="px-5 py-3 text-left font-semibold">Title</th>
                            <th class="px-5 py-3 text-left font-semibold">Year</th>
                            <th class="px-5 py-3 text-left font-semibold">Status</th>
                            <th class="px-5 py-3 text-left font-semibold">Date Submitted</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($items as $item)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="px-5 py-3 font-medium text-gray-900">
                                    <a href="{{ route('items.show', $item->id) }}" target="_blank" class="hover:underline">
                                        {{ Str::limit($item->title, 40) }}
                                    </a>
                                </td>

                                <td class="px-5 py-3">{{ $item->year ?? '—' }}</td>

                                <td class="px-5 py-3">
                                    @switch($item->status)
                                        @case('approved')
                                            <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs font-medium">
                                                Approved
                                            </span>
                                            @break
                                        @case('pending')
                                            <span class="bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full text-xs font-medium">
                                                Pending
                                            </span>
                                            @break
                                        @default
                                            <span class="bg-gray-100 text-gray-700 px-2 py-0.5 rounded-full text-xs font-medium">
                                                Draft
                                            </span>
                                    @endswitch
                                </td>

                                <td class="px-5 py-3">{{ $item->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-5 py-6 text-center text-gray-500">
                                    No submissions yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- View All Button --}}
            <div class="flex justify-end mt-4">
                <a href="{{ route('user.submissions') }}"
                   class="text-sm text-blue-700 hover:text-blue-900 font-medium transition">
                    View All Submissions →
                </a>
            </div>
        </section>

    </main>
</x-user-layout>
