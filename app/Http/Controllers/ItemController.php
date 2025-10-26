<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Person;
use App\Http\Requests\StoreItemRequest;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function __construct()
    {
        // Only logged-in users can create or store items
        $this->middleware(['auth'])->except(['show', 'search']);
    }

    // Show submission form
    public function create()
    {
        $categories = Category::orderBy('order')->get();
        return view('items.create', compact('categories'));
    }

    // Store new item
    public function store(StoreItemRequest $request)
    {
        $item = Item::create($request->safe()->except('files') + ['created_by' => auth()->id()]);

        // Attach authors (students)
        if ($request->filled('authors')) {
            foreach ($request->input('authors') as $name) {
                if (!$name) continue;
                $p = Person::firstOrCreate(['name' => trim($name)]);
                $item->people()->attach($p->id, ['role' => 'author']);
            }
        }

        // Attach supervisors (faculty)
        if ($request->filled('supervisors')) {
            foreach ($request->input('supervisors') as $name) {
                if (!$name) continue;
                $p = Person::firstOrCreate(['name' => trim($name), 'affiliation' => 'faculty']);
                $item->people()->attach($p->id, ['role' => 'supervisor']);
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

        return redirect()->route('items.show', $item)->with('success', 'Item created.');
    }

    // Detect media type
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

    // Show a single item
    public function show(Item $item)
    {
        $item->load(['category.parent', 'media', 'people']);
        abort_if($item->status !== 'published' && !auth()->check(), 404);

        return view('items.show', compact('item'));
    }

    // Search items
    public function search(Request $request)
    {
        $q = Item::published()->with('category');

        if ($s = $request->input('q')) {
            $q->where(function ($qq) use ($s) {
                $qq->where('title', 'like', "%$s%")
                   ->orWhere('abstract', 'like', "%$s%")
                   ->orWhere('course_code', 'like', "%$s%");
            });
        }

        if ($y = $request->integer('year')) {
            $q->where('year', $y);
        }

        if ($t = $request->input('type')) {
            $q->where('type', $t);
        }

        if ($c = $request->input('course')) {
            $q->where('course_code', $c);
        }

        $items = $q->latest()->paginate(24)->withQueryString();

        return view('items.search', compact('items'));
    }
}
