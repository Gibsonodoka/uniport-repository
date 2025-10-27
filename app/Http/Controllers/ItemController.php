<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Person;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function __construct()
    {
        // Only logged-in users can create or store items
        $this->middleware(['auth'])->except(['show', 'search']);
    }

    /**
     * Show submission form.
     */
    public function create()
    {
        $categories = Category::orderBy('order')->get();
        return view('user.create', compact('categories'));
    }

    /**
     * Store a new user submission (defaults to pending).
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'nullable|string',
            'year' => 'nullable|digits:4',
            'type' => 'required|string',
            'course_code' => 'nullable|string|max:10',
            'supervisor' => 'nullable|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'files.*' => 'nullable|file|max:10240', // 10MB limit
        ]);

        $item = Item::create([
            'title' => $request->title,
            'abstract' => $request->abstract,
            'year' => $request->year,
            'type' => $request->type,
            'course_code' => $request->course_code,
            'supervisor' => $request->supervisor,
            'category_id' => $request->category_id,
            'created_by' => auth()->id(),
            'status' => 'pending', // all new submissions must be approved
        ]);

        // Attach authors
        if ($request->filled('authors')) {
            foreach ($request->input('authors') as $name) {
                if (!$name) continue;
                $person = Person::firstOrCreate(['name' => trim($name)]);
                $item->people()->attach($person->id, ['role' => 'author']);
            }
        }

        // Attach supervisors
        if ($request->filled('supervisors')) {
            foreach ($request->input('supervisors') as $name) {
                if (!$name) continue;
                $person = Person::firstOrCreate(['name' => trim($name), 'affiliation' => 'faculty']);
                $item->people()->attach($person->id, ['role' => 'supervisor']);
            }
        }

        // Upload files
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $upload) {
                $path = $upload->store('items/' . ($item->year ?? date('Y')), 'public');
                $item->media()->create([
                    'path' => $path,
                    'mime_type' => $upload->getClientMimeType(),
                    'size_bytes' => $upload->getSize(),
                    'kind' => $this->kindFromMime($upload->getClientMimeType()),
                ]);
            }
        }

        return redirect()->route('user.dashboard')
            ->with('success', 'Your submission has been sent and is pending admin approval.');
    }

    /**
     * Detect media type from MIME.
     */
    private function kindFromMime(?string $mime): string
    {
        return match (true) {
            str_starts_with($mime, 'application/pdf') => 'pdf',
            str_starts_with($mime, 'audio/') => 'audio',
            str_starts_with($mime, 'video/') => 'video',
            str_starts_with($mime, 'image/') => 'image',
            default => 'other',
        };
    }

    /**
     * Display an individual item.
     */
    public function show(Item $item)
    {
        $item->load(['category.parent', 'media', 'people']);

        // Restrict unpublished access
        abort_if($item->status !== 'approved' && !auth()->check(), 404);

        return view('items.show', compact('item'));
    }

    /**
     * Search items (frontend/public search).
     */
    public function search(Request $request)
    {
        $query = Item::where('status', 'approved')->with('category');

        if ($s = $request->input('q')) {
            $query->where(function ($q) use ($s) {
                $q->where('title', 'like', "%$s%")
                  ->orWhere('abstract', 'like', "%$s%")
                  ->orWhere('course_code', 'like', "%$s%");
            });
        }

        if ($year = $request->integer('year')) {
            $query->where('year', $year);
        }

        if ($type = $request->input('type')) {
            $query->where('type', $type);
        }

        $items = $query->latest()->paginate(24)->withQueryString();

        return view('items.search', compact('items'));
    }
}
