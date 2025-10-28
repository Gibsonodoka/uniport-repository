<x-admin-layout>
    <main class="p-6 bg-gray-50 min-h-screen">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Create New Submission</h1>

        @if(session('success'))
            <div class="p-3 bg-green-100 text-green-700 text-sm rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.items.store') }}" enctype="multipart/form-data" class="space-y-4 bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            @csrf

            <input name="title" class="w-full border rounded px-3 py-2" placeholder="Title" required>

            <textarea name="abstract" class="w-full border rounded px-3 py-2" rows="5" placeholder="Abstract"></textarea>

            <div class="grid grid-cols-2 gap-3">
                <input name="year" class="border rounded px-3 py-2" placeholder="Year e.g., 2025">
                <input name="course_code" class="border rounded px-3 py-2" placeholder="Course Code e.g., HIS 201">
            </div>

            <select name="type" class="border rounded px-3 py-2" required>
                <option value="">Select Type</option>
                <option value="final_year_project">Final Year Project</option>
                <option value="term_paper">Term Paper</option>
                <option value="seminar_paper">Seminar Paper</option>
                <option value="oral_history">Oral History</option>
                <option value="faculty_publication">Faculty Publication</option>
                <option value="department_record">Department Record</option>
            </select>

            <select name="category_id" class="border rounded px-3 py-2" required>
                <option value="">Select Collection</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>

            <input name="supervisor" class="w-full border rounded px-3 py-2" placeholder="Supervisor (text)">

            <div>
                <label class="block text-sm mb-1">Authors:</label>
                <input name="authors[]" class="w-full border rounded px-3 py-2 mb-2" placeholder="Author 1">
                <input name="authors[]" class="w-full border rounded px-3 py-2 mb-2" placeholder="Author 2 (optional)">
            </div>

            <div>
                <label class="block text-sm mb-1">Supervisors:</label>
                <input name="supervisors[]" class="w-full border rounded px-3 py-2 mb-2" placeholder="Supervisor 1">
            </div>

            <div>
                <label class="block text-sm mb-1">Files (PDF, audio, video, images):</label>
                <input type="file" name="files[]" multiple class="w-full border rounded px-3 py-2">
            </div>

            <select name="status" class="border rounded px-3 py-2">
                <option value="pending">Pending</option>
                <option value="approved">Approve Immediately</option>
                <option value="draft">Draft</option>
            </select>

            <div class="flex justify-end">
                <button class="bg-blue-700 text-white px-5 py-2 rounded hover:bg-blue-800 transition">
                    Submit
                </button>
            </div>
        </form>
    </main>
</x-admin-layout>
