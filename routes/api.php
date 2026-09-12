<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductVariantController;
use App\Http\Controllers\Api\SizeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WishlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Authentication
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Products / Categories / Brands
// Customer can view these without login
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);

Route::get('/brands', [BrandController::class, 'index']);
Route::get('/brands/{brand}', [BrandController::class, 'show']);

Route::get('/sizes', [SizeController::class, 'index']);
Route::get('/sizes/{size}', [SizeController::class, 'show']);

Route::get('/colors', [ColorController::class, 'index']);
Route::get('/colors/{color}', [ColorController::class, 'show']);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

Route::get('/product-variants', [
    ProductVariantController::class,
    'index'
]);

Route::get('/product-variants/{productVariant}', [
    ProductVariantController::class,
    'show'
]);


/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Authentication
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/me', [AuthController::class, 'me']);
    Route::put('/me', [AuthController::class, 'updateProfile']);

    /*
    |--------------------------------------------------------------------------
    | Wishlist
    |--------------------------------------------------------------------------
    */

    Route::get('/wishlist', [
        WishlistController::class,
        'index'
    ]);

    Route::post('/wishlist/{product}', [
        WishlistController::class,
        'store'
    ]);

    Route::delete('/wishlist/{product}', [
        WishlistController::class,
        'destroy'
    ]);


    /*
    |--------------------------------------------------------------------------
    | Cart
    |--------------------------------------------------------------------------
    */

    Route::get('/cart', [
        CartController::class,
        'index'
    ]);

    Route::post('/cart/items', [
        CartController::class,
        'addItem'
    ]);

    Route::put('/cart/items/{cartItem}', [
        CartController::class,
        'updateItem'
    ]);

    Route::delete('/cart/items/{cartItem}', [
        CartController::class,
        'removeItem'
    ]);

    Route::delete('/cart', [
        CartController::class,
        'clear'
    ]);


    /*
    |--------------------------------------------------------------------------
    | Checkout
    |--------------------------------------------------------------------------
    */

    Route::post('/checkout', [
        CheckoutController::class,
        'store'
    ]);


    /*
    |--------------------------------------------------------------------------
    | Orders
    |--------------------------------------------------------------------------
    */

    Route::get('/orders', [
        OrderController::class,
        'index'
    ]);

    Route::get('/orders/{order}', [
        OrderController::class,
        'show'
    ]);


    /*
    |--------------------------------------------------------------------------
    | Payment
    |--------------------------------------------------------------------------
    */

    Route::post('/orders/{order}/payment', [
        PaymentController::class,
        'store'
    ]);

    Route::get('/orders/{order}/payment', [
        PaymentController::class,
        'show'
    ]);
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', 'admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/users', [AuthController::class, 'index']);


        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        Route::post('/categories', [
            CategoryController::class,
            'store'
        ]);

        Route::put('/categories/{category}', [
            CategoryController::class,
            'update'
        ]);

        Route::delete('/categories/{category}', [
            CategoryController::class,
            'destroy'
        ]);


        /*
        |--------------------------------------------------------------------------
        | Brands
        |--------------------------------------------------------------------------
        */

        Route::post('/brands', [
            BrandController::class,
            'store'
        ]);

        Route::put('/brands/{brand}', [
            BrandController::class,
            'update'
        ]);

        Route::delete('/brands/{brand}', [
            BrandController::class,
            'destroy'
        ]);


        /*
        |--------------------------------------------------------------------------
        | Sizes
        |--------------------------------------------------------------------------
        */

        Route::post('/sizes', [
            SizeController::class,
            'store'
        ]);

        Route::put('/sizes/{size}', [
            SizeController::class,
            'update'
        ]);

        Route::delete('/sizes/{size}', [
            SizeController::class,
            'destroy'
        ]);


        /*
        |--------------------------------------------------------------------------
        | Colors
        |--------------------------------------------------------------------------
        */

        Route::post('/colors', [
            ColorController::class,
            'store'
        ]);

        Route::put('/colors/{color}', [
            ColorController::class,
            'update'
        ]);

        Route::delete('/colors/{color}', [
            ColorController::class,
            'destroy'
        ]);


        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */

        Route::post('/products', [
            ProductController::class,
            'store'
        ]);

        Route::put('/products/{product}', [
            ProductController::class,
            'update'
        ]);

        Route::delete('/products/{product}', [
            ProductController::class,
            'destroy'
        ]);


        /*
        |--------------------------------------------------------------------------
        | Product Variants
        |--------------------------------------------------------------------------
        */

        Route::post('/product-variants', [
            ProductVariantController::class,
            'store'
        ]);

        Route::put('/product-variants/{productVariant}', [
            ProductVariantController::class,
            'update'
        ]);

        Route::delete('/product-variants/{productVariant}', [
            ProductVariantController::class,
            'destroy'
        ]);


        /*
        |--------------------------------------------------------------------------
        | Orders
        |--------------------------------------------------------------------------
        */

        Route::get('/orders', [
            AdminOrderController::class,
            'index'
        ]);

        Route::get('/orders/{order}', [
            AdminOrderController::class,
            'show'
        ]);

        Route::put('/orders/{order}/status', [
            AdminOrderController::class,
            'updateStatus'
        ]);

        Route::put('/orders/{order}/payment-status', [
            AdminOrderController::class,
            'updatePaymentStatus'
        ]);
    });
