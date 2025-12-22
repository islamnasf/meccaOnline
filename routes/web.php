<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/nabinaMohamed', function () {
    return view('dashboard/nabinaMohame');
});


Route::get('/dashboard', function () {
    return view('dashboard/index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('getUser');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::post('/users/update', [UserController::class, 'update'])->name('users.update');
    Route::post('/users/delete', [UserController::class, 'destroy'])->name('users.delete');

    Route::prefix('dashboard/orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::post('/store', [OrderController::class, 'store'])->name('orders.store');
        Route::post('/update', [OrderController::class, 'update'])->name('orders.update');
        Route::post('/delete', [OrderController::class, 'delete'])->name('orders.delete');
        Route::post('/status', [OrderController::class, 'updateStatus'])->name('orders.status');
    });
    Route::prefix('dashboard')->group(function () {
        Route::get('hotels', [HotelController::class, 'index'])->name('hotels.index');
        Route::post('hotels/store', [HotelController::class, 'store'])->name('hotels.store');
        Route::post('hotels/update', [HotelController::class, 'update'])->name('hotels.update');
        Route::post('hotels/delete', [HotelController::class, 'delete'])->name('hotels.delete');
        Route::post('hotels/assign-users', [HotelController::class, 'assignUsers'])->name('hotels.assignUsers');

    });
    Route::prefix('dashboard/hotel-details')->group(function () {
        Route::get('/{hotel}', [HotelController::class, 'indexDetails'])->name('hotel_details.index');
        Route::post('/store', [HotelController::class, 'storeDetail'])->name('hotel_details.store');
        Route::post('/update', [HotelController::class, 'updateDetail'])->name('hotel_details.update');
        Route::post('/delete', [HotelController::class, 'destroyDetail'])->name('hotel_details.delete');

        // مسارات أنواع العناصر
        Route::post('/item-types/store', [HotelController::class, 'storeItemType'])->name('item_types.store');
        Route::post('/item-types/delete', [HotelController::class, 'destroyItemType'])->name('item_types.delete');
    });

})->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
