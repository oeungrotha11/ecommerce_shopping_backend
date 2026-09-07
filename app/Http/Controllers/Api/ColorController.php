<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
      /**
     * Get all colors
     */
    public function index()
    {
        $colors = Color::latest()->get();

        return response()->json([
            'message' => 'Colors retrieved successfully',
            'data' => $colors,
        ]);
    }

    /**
     * Create color
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:colors,name',
            'hex_code' => [
                'nullable',
                'string',
                'regex:/^#[0-9A-Fa-f]{6}$/',
            ],
        ]);

        $color = Color::create($validated);

        return response()->json([
            'message' => 'Color created successfully',
            'data' => $color,
        ], 201);
    }

    /**
     * Get one color
     */
    public function show(Color $color)
    {
        return response()->json([
            'message' => 'Color retrieved successfully',
            'data' => $color,
        ]);
    }

    /**
     * Update color
     */
    public function update(Request $request, Color $color)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:colors,name,' . $color->id,

            'hex_code' => [
                'nullable',
                'string',
                'regex:/^#[0-9A-Fa-f]{6}$/',
            ],
        ]);

        $color->update($validated);

        return response()->json([
            'message' => 'Color updated successfully',
            'data' => $color,
        ]);
    }

    /**
     * Delete color
     */
    public function destroy(Color $color)
    {
        $color->delete();

        return response()->json([
            'message' => 'Color deleted successfully',
        ]);
    }
}
