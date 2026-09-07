<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
     public function index()
    {
        $products = Product::with([
            'category',
            'brand',
            'variants.size',
            'variants.color',
        ])->latest()->get();

        return response()->json([
            'message' => 'Products retrieved successfully',
            'data' => $products,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',

            'code' => 'required|string|max:100|unique:products,code',

            'name' => 'required|string|max:255',

            'description' => 'nullable|string',

            'base_price' => 'required|numeric|min:0',

            'image' => 'nullable|string|max:255',

            'status' => 'nullable|in:active,inactive',
        ]);

        $product = Product::create($validated);

        return response()->json([
            'message' => 'Product created successfully',
            'data' => $product,
        ], 201);
    }

    public function show(Product $product)
    {
        $product->load([
            'category',
            'brand',
            'variants.size',
            'variants.color',
        ]);

        return response()->json([
            'message' => 'Product retrieved successfully',
            'data' => $product,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'sometimes|required|exists:categories,id',

            'brand_id' => 'sometimes|required|exists:brands,id',

            'code' => 'sometimes|required|string|max:100|unique:products,code,' . $product->id,

            'name' => 'sometimes|required|string|max:255',

            'description' => 'nullable|string',

            'base_price' => 'sometimes|required|numeric|min:0',

            'image' => 'nullable|string|max:255',

            'status' => 'sometimes|in:active,inactive',
        ]);

        $product->update($validated);

        return response()->json([
            'message' => 'Product updated successfully',
            'data' => $product,
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully',
        ]);
    }
}
