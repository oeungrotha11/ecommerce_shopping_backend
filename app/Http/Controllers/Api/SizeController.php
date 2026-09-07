<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::latest()->get();

        return response()->json([
            'message' => 'Sizes retrieved successfully',
            'data' => $sizes,
        ]);
    }

     public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:20|unique:sizes,name',
        ]);

        $size = Size::create($validated);

        return response()->json([
            'message' => 'Size created successfully',
            'data' => $size,
        ], 201);
    }

     /**
     * Get one size
     */
    public function show(Size $size)
    {
        return response()->json([
            'message' => 'Size retrieved successfully',
            'data' => $size,
        ]);
    }

    /**
     * Update size
     */
    public function update(Request $request, Size $size)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:20|unique:sizes,name,' . $size->id,
        ]);

        $size->update($validated);

        return response()->json([
            'message' => 'Size updated successfully',
            'data' => $size,
        ]);
    }

    /**
     * Delete size
     */
    public function destroy(Size $size)
    {
        $size->delete();

        return response()->json([
            'message' => 'Size deleted successfully',
        ]);
    }

}
