<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
     // GET /api/wishlist
    public function index(Request $request)
    {
        $wishlist = Wishlist::with([
            'product.category',
            'product.brand',
            'product.variants.size',
            'product.variants.color',
        ])
        ->where('user_id', $request->user()->id)
        ->latest()
        ->get();

        return response()->json($wishlist);
    }

    // POST /api/wishlist/{product}
    public function store(Request $request, Product $product)
    {
        $wishlist = Wishlist::firstOrCreate([
            'user_id' => $request->user()->id,
            'product_id' => $product->id,
        ]);

        return response()->json([
            'message' => 'Product added to wishlist',
            'wishlist' => $wishlist->load('product'),
        ], 201);
    }

    // DELETE /api/wishlist/{product}
    public function destroy(Request $request, Product $product)
    {
        Wishlist::where('user_id', $request->user()->id)
            ->where('product_id', $product->id)
            ->delete();

        return response()->json([
            'message' => 'Product removed from wishlist',
        ]);
    }
}
