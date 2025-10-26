<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Submit Your Work</h1>

        <form method="post" action="{{ route('items.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input name="title" class="w-full border rounded px-3 py-2" placeholder="Title" required />

            <textarea name="abstract" class="w-full border rounded px-3 py-2" rows="5" placeholder="Abstract"></textarea>

            <div class="grid grid-cols-2 gap-3">
                <input name="year" class="border rounded px-3 py-2" placeholder="Year e.g., 2025" />
                <input name="course_code" class="border rounded px-3 py-2" placeholder="Course code e.g., HIS 201" />
            </div>

            <select name="type" class="border rounded px-3 py-2" required>
                <option value="">Type</option>
                <option value="final_year_project">Final Year Project</option>
                <option value="term_paper">Term Paper</option>
                <option value="seminar_paper">Seminar Paper</option>
                <option value="oral_history">Oral History</option>
                <option value="faculty_publication">Faculty Publication</option>
                <option value="department_record">Department Record</option>
            </select>

            <select name="category_id" class="border rounded px-3 py-2" required>
                <option value="">Select collection</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>

            <input name="supervisor" class="w-full border rounded px-3 py-2" placeholder="Supervisor (text)" />

            <div>
                <label class="block text-sm mb-1">Authors (add multiple names):</label>
                <input name="authors[]" class="w-full border rounded px-3 py-2 mb-2" placeholder="Author 1" />
                <input name="authors[]" class="w-full border rounded px-3 py-2 mb-2" placeholder="Author 2 (optional)" />
            </div>

            <div>
                <label class="block text-sm mb-1">Supervisors (link to people records):</label>
                <input name="supervisors[]" class="w-full border rounded px-3 py-2 mb-2" placeholder="Supervisor 1" />
            </div>

            <div>
                <label class="block text-sm mb-1">Files (PDF, audio/video, images) — max 6:</label>
                <input type="file" name="files[]" multiple />
            </div>

            <select name="status" class="border rounded px-3 py-2">
                <option value="draft">Draft</option>
                <option value="published">Publish</option>
            </select>

            <button class="bg-gray-900 text-white px-4 py-2 rounded">Submit</button>
        </form>
    </div>
</x-app-layout>
