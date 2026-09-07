<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
     public function index()
    {
        $variants = ProductVariant::with([
            'product',
            'size',
            'color',
        ])->latest()->get();

        return response()->json([
            'message' => 'Product variants retrieved successfully',
            'data' => $variants,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',

            'size_id' => 'required|exists:sizes,id',

            'color_id' => 'required|exists:colors,id',

            'sku' => 'required|string|max:100|unique:product_variants,sku',

            'price' => 'nullable|numeric|min:0',

            'stock' => 'required|integer|min:0',

            'image' => 'nullable|string|max:255',
        ]);

        $variant = ProductVariant::create($validated);

        $variant->load([
            'product',
            'size',
            'color',
        ]);

        return response()->json([
            'message' => 'Product variant created successfully',
            'data' => $variant,
     ], 201);
    }

    public function show(ProductVariant $productVariant)
    {
        $productVariant->load([
            'product',
            'size',
            'color',
        ]);

        return response()->json([
            'message' => 'Product variant retrieved successfully',
            'data' => $productVariant,
        ]);
    }

    public function update(
        Request $request,
        ProductVariant $productVariant
    ) {
        $validated = $request->validate([
            'product_id' => 'sometimes|required|exists:products,id',

            'size_id' => 'sometimes|required|exists:sizes,id',

            'color_id' => 'sometimes|required|exists:colors,id',

            'sku' => 'sometimes|required|string|max:100|unique:product_variants,sku,' . $productVariant->id,

            'price' => 'nullable|numeric|min:0',

            'stock' => 'sometimes|required|integer|min:0',

            'image' => 'nullable|string|max:255',
        ]);

        $productVariant->update($validated);

        $productVariant->load([
            'product',
            'size',
            'color',
        ]);

        return response()->json([
            'message' => 'Product variant updated successfully',
            'data' => $productVariant,
        ]);
    }

    public function destroy(ProductVariant $productVariant)
    {
        $productVariant->delete();

        return response()->json([
            'message' => 'Product variant deleted successfully',
        ]);
    }
}
