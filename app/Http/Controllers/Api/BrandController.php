<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->get();

        return response()->json([
            'message' => 'Brands retrieved successfully',
            'data' => $brands,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:brands,name',
            'logo' => 'nullable|string|max:255',
        ]);

        $brand = Brand::create($validated);

        return response()->json([
            'message' => 'Brand created successfully',
            'data' => $brand,
        ], 201);
    }

    /**
     * Get one brand by ID
     */
    public function show(Brand $brand)
    {
        return response()->json([
            'message' => 'Brand retrieved successfully',
            'data' => $brand,
        ]);
    }

    /**
     * Update brand by ID
     */
    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:brands,name,' . $brand->id,
            'logo' => 'nullable|string|max:255',
        ]);

        $brand->update($validated);

        return response()->json([
            'message' => 'Brand updated successfully',
            'data' => $brand,
        ]);
    }

     /**
     * Delete brand
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return response()->json([
            'message' => 'Brand deleted successfully',
        ]);
    }
}
