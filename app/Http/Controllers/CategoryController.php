<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $roots = Category::whereNull('parent_id')->with('children.children')->orderBy('order')->get();
        return view('categories.index', compact('roots'));
    }

    public function show(Category $category)
    {
        $category->load(['children','items' => fn($q)=>$q->published()->latest()]);
        return view('categories.show', compact('category'));
    }
}
