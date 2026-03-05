<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShippingAddressController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;


/*
|--------------------------------------------------------------------------
| HOME & SHOP
|--------------------------------------------------------------------------
*/

Route::get('/', [ShopController::class, 'index'])->name('home');

Route::get('/shop', [ShopController::class, 'index'])
    ->name('shop');

Route::get('/product/{product}', [ShopController::class, 'show'])
    ->name('product.show');

Route::get('/category/{id}', [ShopController::class, 'category'])
    ->name('category.show');


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login.form');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login');

Route::get('/register', [AuthController::class, 'showRegisterForm'])
    ->name('register.form');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| ROUTES CẦN ĐĂNG NHẬP
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | CART
    |--------------------------------------------------------------------------
    */

    Route::prefix('cart')->group(function () {

        Route::get('/', [CartController::class, 'index'])
            ->name('cart.index');

        Route::post('/add/{product}', [CartController::class, 'add'])
            ->name('cart.add');

        Route::delete('/remove/{product}', [CartController::class, 'remove'])
            ->name('cart.remove');

        Route::post('/update/{product}', [CartController::class, 'update'])
            ->name('cart.update');
    });

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::prefix('profile')->group(function () {

        Route::get('/', [ProfileController::class, 'show'])
            ->name('profile.info');

        Route::get('/edit', [ProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::put('/edit', [ProfileController::class, 'update'])
            ->name('profile.update');

        Route::get('/change-password', function () {
            return view('profile.change-password');
        })->name('profile.change-password');

        Route::post('/update-password', [ProfileController::class, 'updatePassword'])
            ->name('profile.update-password');
    });

    /*
    |--------------------------------------------------------------------------
    | SHIPPING ADDRESS
    |--------------------------------------------------------------------------
    */

    Route::prefix('profile/addresses')->group(function () {

        Route::get('/', [ShippingAddressController::class, 'index'])
            ->name('profile.addresses');

        Route::get('/create', [ShippingAddressController::class, 'create'])
            ->name('profile.addresses.create');

        Route::post('/', [ShippingAddressController::class, 'store'])
            ->name('profile.addresses.store');

        Route::get('/{id}/edit', [ShippingAddressController::class, 'edit'])
            ->name('profile.addresses.edit');

        Route::put('/{id}', [ShippingAddressController::class, 'update'])
            ->name('profile.addresses.update');

        Route::delete('/{id}', [ShippingAddressController::class, 'destroy'])
            ->name('profile.addresses.destroy');

        Route::post('/{id}/default', [ShippingAddressController::class, 'setDefault'])
            ->name('profile.addresses.setDefault');
    });

});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware(['auth'])
    ->name('admin.')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('users', UserController::class);
    });


Route::delete('/cart/delete-selected', [CartController::class, 'deleteSelected'])
->name('cart.deleteSelected');

Route::middleware(['auth'])->group(function () {

    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

});

Route::post('/checkout', [CartController::class, 'goToCheckout'])
    ->name('checkout.go')
    ->middleware('auth');

Route::post('/change-address/{id}', [CheckoutController::class, 'changeAddress'])
    ->name('checkout.changeAddress');