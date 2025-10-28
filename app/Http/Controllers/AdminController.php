<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Person;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $total = Item::count();
        $approved = Item::where('status', 'approved')->count();
        $pending = Item::where('status', 'pending')->count();

        $pendingItems = Item::where('status', 'pending')
            ->with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.index', compact('total', 'approved', 'pending', 'pendingItems'));
    }

    public function submissions(Request $request)
    {
        $query = Item::with('user')->latest();

        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('course_code', 'like', "%{$search}%")
                  ->orWhere('supervisor', 'like', "%{$search}%");
            });
        }

        $items = $query->paginate(15)->withQueryString();

        return view('admin.submissions', compact('items'));
    }

    public function approve(Item $item)
    {
        if ($item->status === 'approved') {
            return back()->with('info', 'This submission is already approved.');
        }

        $item->update(['status' => 'approved']);
        return back()->with('success', 'Submission approved successfully.');
    }

    /** CATEGORY MANAGEMENT **/
    public function categories()
    {
        $categories = Category::with('parent')->orderBy('parent_id')->orderBy('order')->get();
        $parents = Category::whereNull('parent_id')->get();
        return view('admin.categories', compact('categories', 'parents'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|integer|exists:categories,id',
            'order' => 'nullable|integer|min:0',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug ?? str()->slug($request->name),
            'description' => $request->description,
            'parent_id' => $request->parent_id,
            'order' => $request->order ?? 0,
        ]);

        return back()->with('success', 'Category created successfully.');
    }

    public function deleteCategory(Category $category)
    {
        if ($category->children()->count() > 0) {
            return back()->with('error', 'Cannot delete a parent category with subcategories.');
        }

        $category->delete();
        return back()->with('success', 'Category deleted successfully.');
    }

    /** ✅ ADMIN CREATE SUBMISSIONS **/

    // Show the form
    public function createItem()
    {
        $categories = Category::orderBy('order')->get();
        return view('admin.create-item', compact('categories'));
    }

    // Handle submission
    public function storeItem(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'nullable|string',
            'year' => 'nullable|integer',
            'course_code' => 'nullable|string|max:50',
            'type' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'supervisor' => 'nullable|string|max:255',
            'authors' => 'nullable|array',
            'supervisors' => 'nullable|array',
            'files.*' => 'nullable|file|max:10240', // 10MB each
            'status' => 'required|string|in:draft,published,pending,approved',
        ]);

        $item = Item::create([
            ...$validated,
            'created_by' => auth()->id(),
        ]);

        // Handle authors
        if ($request->filled('authors')) {
            foreach ($request->input('authors') as $name) {
                if (!$name) continue;
                $p = Person::firstOrCreate(['name' => trim($name)]);
                $item->people()->attach($p->id, ['role' => 'author']);
            }
        }

        // Handle supervisors
        if ($request->filled('supervisors')) {
            foreach ($request->input('supervisors') as $name) {
                if (!$name) continue;
                $p = Person::firstOrCreate(['name' => trim($name), 'affiliation' => 'faculty']);
                $item->people()->attach($p->id, ['role' => 'supervisor']);
            }
        }

        // Handle files
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $upload) {
                $path = $upload->store('items/' . ($item->year ?? date('Y')), 'public');
                $item->media()->create([
                    'path' => $path,
                    'mime_type' => $upload->getClientMimeType(),
                    'size_bytes' => $upload->getSize(),
                    'kind' => $this->kindFromMime($upload->getClientMimeType()),
                    'disk' => 'public',
                ]);
            }
        }

        return redirect()->route('admin.submissions')->with('success', 'Submission created successfully.');
    }

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
}
