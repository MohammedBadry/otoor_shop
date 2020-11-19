<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Accounts\Dashboard\AdminController;
use App\Http\Controllers\Countries\Dashboard\CityController;
use App\Http\Controllers\Accounts\Dashboard\AddressController;
use App\Http\Controllers\Products\Dashboard\ProductController;
use App\Http\Controllers\Accounts\Dashboard\CustomerController;
use App\Http\Controllers\Countries\Dashboard\CountryController;
use App\Http\Controllers\Currencies\Dashboard\CurrencyController;
use App\Http\Controllers\Currencies\Dashboard\CurrencyRateController;
use App\Http\Controllers\Categories\Dashboard\CategoryController;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('locale/{locale}', [LocaleController::class, 'update'])
    ->name('locale')
    ->where('locale', '(ar|en)');

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::prefix('accounts')->group(function () {
    Route::resource('admins', AdminController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('customers.addresses', AddressController::class);
});

// Settings
Route::resource('settings', SettingController::class)->only('index', 'store');

// Countries
Route::resource('countries', CountryController::class);
Route::resource('countries.cities', CityController::class)->except('create', 'show');

// Currencies
Route::resource('currencies', CurrencyController::class);
Route::resource('currencies.rates', CurrencyRateController::class)->except('create', 'show');

// Categories
Route::resource('categories', CategoryController::class);

// Products
Route::resource('products', ProductController::class);

Route::resource('brands', \App\Http\Controllers\Brands\Dashboard\BrandController::class);

Route::resource('orders', \App\Http\Controllers\Orders\Dashboard\OrderController::class)->except('create', 'store');
Route::resource('offers', \App\Http\Controllers\Offers\Dashboard\OfferController::class)->except('index', 'show');
Route::resource('coupons', \App\Http\Controllers\Coupons\Dashboard\CouponController::class);
Route::resource('collections', \App\Http\Controllers\Collections\Dashboard\CollectionController::class);
Route::resource('testers', \App\Http\Controllers\Testers\Dashboard\TesterController::class);
Route::resource('pages', \App\Http\Controllers\Pages\Dashboard\PageController::class);
Route::resource('sizes', \App\Http\Controllers\Sizes\Dashboard\SizeController::class);
