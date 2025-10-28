<x-admin-layout>
    <main class="p-6 space-y-8">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Manage Categories</h1>
        </div>

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="p-3 bg-green-100 text-green-700 text-sm rounded">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="p-3 bg-red-100 text-red-700 text-sm rounded">{{ session('error') }}</div>
        @endif

        {{-- Create Category Form --}}
        <div class="bg-white shadow-sm rounded-lg p-6 border border-gray-100">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Add New Category</h2>

            <form method="POST" action="{{ route('admin.categories.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Name</label>
                    <input type="text" name="name" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Category name">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Slug (optional)</label>
                    <input type="text" name="slug" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Auto-generated if empty">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-600 mb-1">Description (optional)</label>
                    <textarea name="description" rows="2" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Parent Category (optional)</label>
                    <select name="parent_id" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                        <option value="">None</option>
                        @foreach($parents as $parent)
                            <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Order (optional)</label>
                    <input type="number" name="order" min="0" value="0" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="md:col-span-2 flex justify-end mt-3">
                    <button type="submit" class="bg-blue-700 text-white px-5 py-2 rounded-lg hover:bg-blue-800 transition">
                        + Create Category
                    </button>
                </div>
            </form>
        </div>

        {{-- Category List --}}
        <div class="bg-white shadow-sm rounded-lg p-6 border border-gray-100">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Existing Categories</h2>

            <table class="w-full text-sm text-gray-700">
                <thead class="bg-blue-900 text-white text-xs uppercase">
                    <tr>
                        <th class="px-5 py-3 text-left">Name</th>
                        <th class="px-5 py-3 text-left">Parent</th>
                        <th class="px-5 py-3 text-left">Description</th>
                        <th class="px-5 py-3 text-left">Order</th>
                        <th class="px-5 py-3 text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $cat)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-5 py-3 font-medium text-gray-900">{{ $cat->name }}</td>
                            <td class="px-5 py-3">{{ $cat->parent?->name ?? '—' }}</td>
                            <td class="px-5 py-3 text-gray-500">{{ $cat->description ?? '—' }}</td>
                            <td class="px-5 py-3">{{ $cat->order }}</td>
                            <td class="px-5 py-3 text-right">
                                <form method="POST" action="{{ route('admin.categories.delete', $cat->id) }}" onsubmit="return confirm('Delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:text-red-800 text-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-6 text-center text-gray-500">No categories available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</x-admin-layout>
