<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->get();

        return response()->json([
            'message' => 'Categories retrieved successfully',
            'data' => $categories,
        ]);
    }

     public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return response()->json([
            'message' => 'Category created successfully',
            'data' => $category,
        ], 201);
    }

    /**
     * Display one category.
     */
    public function show(Category $category)
    {
        $category->load('parent', 'children');

        return response()->json([
            'message' => 'Category retrieved successfully',
            'data' => $category,
        ]);
    }

    /**
     * Update category.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return response()->json([
            'message' => 'Category updated successfully',
            'data' => $category,
        ]);
    }

    /**
     * Delete category.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully',
        ]);
    }

}
