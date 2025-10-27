<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class UserDashboardController extends Controller
{
    /**
     * Display user dashboard with summary and recent submissions.
     */
    public function index()
    {
        $userId = auth()->id();

        // Fetch latest 5 submissions
        $items = Item::where('created_by', $userId)
            ->latest()
            ->take(5)
            ->get();

        // Summary stats
        return view('user.dashboard', [
            'items' => $items,
            'totalSubmissions' => Item::where('created_by', $userId)->count(),
            'approved' => Item::where('created_by', $userId)->where('status', 'approved')->count(),
            'pending' => Item::where('created_by', $userId)->where('status', 'pending')->count(),
        ]);
    }

    /**
     * Show a paginated list of all user submissions.
     */
    public function submissions(Request $request)
    {
        $userId = auth()->id();

        // Build query for user’s items
        $query = Item::where('created_by', $userId)->latest();

        // Optional keyword filter
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                  ->orWhere('course_code', 'like', '%' . $request->q . '%')
                  ->orWhere('supervisor', 'like', '%' . $request->q . '%');
            });
        }

        // Paginate results
        $items = $query->paginate(10);

        return view('user.submissions', compact('items'));
    }
}
