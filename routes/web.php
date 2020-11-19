<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('dashboard.locales')->group(function () {
    Auth::routes();
});

Route::middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])
    ->prefix(LaravelLocalization::setLocale())->group(function () {
        Route::middleware('auth:sanctum')->get('wishlist', [\App\Http\Controllers\UserController::class, 'wishlist']);
        Route::middleware('auth:sanctum')->get('orders', [\App\Http\Controllers\OrderController::class, 'index']);
        Route::middleware('auth:sanctum')->get(
            'orders/{order}',
            [\App\Http\Controllers\OrderController::class, 'show']
        );
        Route::middleware('auth:sanctum')->get(
            'orders/{order}/pay',
            [\App\Http\Controllers\OrderController::class, 'pay']
        );

        Route::get('/payment/failed', [\App\Http\Controllers\CheckoutController::class, 'paymentFailed'])->name('payment.failed');
        Route::get('/checkout', [\App\Http\Controllers\CheckoutController::class, 'show']);
        Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'store']);
        Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index']);
        Route::post('/cart', [\App\Http\Controllers\CartController::class, 'add']);
        Route::put('/cart/update', [\App\Http\Controllers\CartController::class, 'update']);
        Route::delete('/cart', [\App\Http\Controllers\CartController::class, 'destroy']);
        Route::post('coupons', [\App\Http\Controllers\CouponController::class, 'apply']);

        Route::get('/{country:code?}', [\App\Http\Controllers\HomeController::class, 'index']);
        Route::get('currencies/{currency}', [\App\Http\Controllers\CurrencyController::class, 'change']);
        Route::get('/categories/{category}', [\App\Http\Controllers\CategoryController::class, 'show'])
            ->name('web.categories.show');
        Route::get('/brands/{brand}', [\App\Http\Controllers\BrandController::class, 'show'])
            ->name('web.brands.show');
        Route::get('/products/{product}', [\App\Http\Controllers\ProductController::class, 'show'])
            ->name('web.products.show');
        Route::get('/collections/{collection}', [\App\Http\Controllers\CollectionController::class, 'show'])
            ->name('web.collections.show');
        Route::get('/testers/{tester}', [\App\Http\Controllers\TesterController::class, 'show'])
            ->name('web.testers.show');

        Route::post(
            'products/{product}/add-to-favorite',
            [\App\Http\Controllers\ProductController::class, 'addToFavorite']
        )
            ->name('products.favorites.add');

        Route::delete(
            'products/{product}/remove-from-favorite',
            [\App\Http\Controllers\ProductController::class, 'removeFromFavorite']
        )
            ->name('products.favorites.remove');
    });
