<x-user-layout>
    <main class="max-w-3xl mx-auto p-6 bg-white shadow-sm rounded-lg border border-gray-100 mt-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Submit Your Work</h1>

        {{-- Success & Error Alerts --}}
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 text-sm rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 text-sm rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            {{-- Title --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
                <input name="title" value="{{ old('title') }}" required
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Enter work title">
            </div>

            {{-- Abstract --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Abstract</label>
                <textarea name="abstract" rows="4"
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                          placeholder="Brief description of your work...">{{ old('abstract') }}</textarea>
            </div>

            {{-- Year & Course Code --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Year</label>
                    <input name="year" value="{{ old('year') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="e.g., 2025">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Course Code</label>
                    <input name="course_code" value="{{ old('course_code') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="e.g., HIS 201">
                </div>
            </div>

            {{-- Type --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Type <span class="text-red-500">*</span></label>
                <select name="type" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select type</option>
                    <option value="final_year_project">Final Year Project</option>
                    <option value="term_paper">Term Paper</option>
                    <option value="seminar_paper">Seminar Paper</option>
                    <option value="oral_history">Oral History</option>
                    <option value="faculty_publication">Faculty Publication</option>
                    <option value="department_record">Department Record</option>
                </select>
            </div>

            {{-- Category --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Collection <span class="text-red-500">*</span></label>
                <select name="category_id" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select collection</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Supervisor --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Supervisor</label>
                <input name="supervisor" value="{{ old('supervisor') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Enter supervisor name">
            </div>

            {{-- Authors --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Authors</label>
                <input name="authors[]" class="w-full border rounded px-3 py-2 mb-2" placeholder="Author 1" />
                <input name="authors[]" class="w-full border rounded px-3 py-2 mb-2" placeholder="Author 2 (optional)" />
            </div>

            {{-- Files --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Upload Files (max 6)</label>
                <input type="file" name="files[]" multiple
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                <p class="text-xs text-gray-500 mt-1">Accepted formats: PDF, images, audio, or video files</p>
            </div>

            {{-- Hidden status (always pending for admin approval) --}}
            <input type="hidden" name="status" value="pending">

            {{-- Submit --}}
            <button type="submit"
                    class="bg-blue-700 text-white px-5 py-2.5 rounded-lg hover:bg-blue-800 transition font-semibold">
                Submit Work
            </button>
        </form>
    </main>
</x-user-layout>
