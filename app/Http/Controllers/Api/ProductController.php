<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
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

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());

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

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

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
