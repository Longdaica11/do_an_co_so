<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShippingAddressController;



Route::get('/', function () {
    return view('home');
})->name('home');

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login.form');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login');

/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/
Route::get('/register', [AuthController::class, 'showRegisterForm'])
    ->name('register.form');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register');


Route::middleware(['auth'])->group(function () {
    Route::get('/shop', function () {
        return view('shop.index');
    });
    
    Route::get('/cart', function () {
        return view('cart.index');
    });
    
});


// profile
Route::middleware(['auth'])->prefix('profile')->group(function () {

    // Xem thông tin
    Route::get('/', [ProfileController::class, 'show'])->name('profile.info');

    // Trang sửa
    Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    // Cập nhật
    Route::put('/edit', [ProfileController::class, 'update'])->name('profile.update');

});

Route::prefix('profile/addresses')
    ->middleware('auth')
    ->group(function () {

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