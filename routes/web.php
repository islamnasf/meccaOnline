<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Models\Category;
use App\Models\Vendor;
use App\Models\VendorService;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/nabinaMohamed', function () {
    return view('dashboard/nabinaMohame');
});


Route::get('/dashboard', function () {
    $totalVendors = Vendor::count();
    $activeVendors = Vendor::where('is_active', true)->count();
    $totalServices = VendorService::count();
    $totalCategories = Category::count();
    $recentVendors = Vendor::with('category')->latest()->take(10)->get();

    return view('dashboard/index', compact(
        'totalVendors',
        'activeVendors',
        'totalServices',
        'totalCategories',
        'recentVendors'
    ));
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


    Route::prefix('dashboard/vendor')->group(function () {
        Route::get('/add', [VendorController::class, 'addNewVendor'])->name('addNewVendor');

    });


    // Vendors Routes
    Route::prefix('dashboard/vendors')->name('vendors.')->group(function () {
        Route::get('/', [VendorController::class, 'index'])->name('index');
        Route::get('/create', [VendorController::class, 'create'])->name('create');
        Route::post('/store', [VendorController::class, 'store'])->name('store');
        Route::get('/{id}', [VendorController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [VendorController::class, 'edit'])->name('edit');
        Route::post('/{id}', [VendorController::class, 'update'])->name('update');
        Route::delete('/{id}', [VendorController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/toggle-status', [VendorController::class, 'toggleStatus'])->name('toggle-status');
        Route::post('/{id}/upload-media', [VendorController::class, 'uploadMedia'])->name('upload-media');
        Route::delete('/media/{id}', [VendorController::class, 'deleteMedia'])->name('delete-media');
            Route::post('/vendors/delete', [VendorController::class, 'destroy'])->name('delete');

    });

    // Categories Routes
    Route::prefix('categories')->group(function () {
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/categories/update', [CategoryController::class, 'update'])->name('categories.update');
        Route::post('/categories/delete', [CategoryController::class, 'destroy'])->name('categories.delete');
    Route::post('/categories/delete-image', [CategoryController::class, 'deleteImage'])->name('categories.deleteImage');
    });



})->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
