<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        // Check if the request expects JSON response
        if ($request->expectsJson()) {
            return CategoryResource::collection($categories);
        }

        return view('categories.index', compact('categories'));
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());

        // Check if the request expects JSON response
        if ($request->expectsJson()) {
            return new CategoryResource($category);
        }

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }
}
