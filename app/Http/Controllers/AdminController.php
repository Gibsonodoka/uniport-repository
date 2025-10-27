<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with summary stats.
     */
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

    /**
     * Display all submissions with filtering and search.
     */
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

    /**
     * Approve a pending submission.
     */
    public function approve(Item $item)
    {
        if ($item->status === 'approved') {
            return back()->with('info', 'This submission is already approved.');
        }

        $item->update(['status' => 'approved']);

        return back()->with('success', 'Submission approved successfully.');
    }

    /**
     * Display all categories.
     */
    public function categories()
    {
        $categories = Category::latest()->get();

        return view('admin.categories', compact('categories'));
    }
}
