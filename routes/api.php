<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\Admin\OrderController as AdminOrderController;     
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Api\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Api\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Api\Admin\CMSController as AdminCMSController;
use App\Http\Controllers\Api\AdminAuthController;

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// İşçi və ya Admin qeydiyyatı (şəbəkə daxilindən adminlər tərəfindən və ya ayrıca linklə)
Route::post('/admin/register-staff', [AdminAuthController::class, 'registerStaff']);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blogs/{id}', [BlogController::class, 'show']);
Route::get('/public-cms', [App\Http\Controllers\Api\Admin\CMSController::class, 'index']);

Route::get('/orders', [OrderController::class, 'userOrders']);
Route::post('/orders', [OrderController::class, 'store']);
Route::get('/orders/{id}', [OrderController::class, 'show']);

// Tenant Owner Route Group (Shop Admin)
// Normally wrapped in 'auth:sanctum' and 'role:shop_admin'
Route::prefix('shop-admin')->group(function () {
    // These will point to the newly created ShopAdmin controllers.
    // E.g., ProductController, CustomerController, SettingsController, KdsController
    // I am scaffolding them here.
});

// Admin routes (for shop owners/baristas)
Route::prefix('admin')->middleware(['auth:sanctum'])->group(function () {
    
    // KDS və Sifarişlər - həm admin, həm də worker (aşpaz/barista) görə bilər
    Route::middleware(['role:admin,worker'])->group(function () {
        Route::get('/orders', [AdminOrderController::class, 'index']);
        Route::put('/orders/{order}/status', [AdminOrderController::class, 'updateStatus']);
    });

    // Qalan bütün admin əməliyyatları - YALNIZ admin görə bilər
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/profile', [\App\Http\Controllers\Api\Admin\ProfileController::class, 'show']);
        Route::put('/profile', [\App\Http\Controllers\Api\Admin\ProfileController::class, 'update']);

        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy']); 

        // Products
        Route::apiResource('/products', AdminProductController::class);

        // Blogs
        Route::apiResource('/blogs', AdminBlogController::class);

        // Customers
        Route::get('/customers', [AdminCustomerController::class, 'index']);        
        Route::delete('/customers/{id}', [AdminCustomerController::class, 'destroy']);

        // Workers
        Route::apiResource('/workers', \App\Http\Controllers\Api\Admin\WorkerController::class);

        // Ingredients (Anbar)
        Route::apiResource('/ingredients', \App\Http\Controllers\Api\Admin\IngredientController::class);

        // CMS
        Route::get('/cms', [AdminCMSController::class, 'index']);
        Route::post('/cms', [AdminCMSController::class, 'store']);
        Route::put('/cms/{id}', [AdminCMSController::class, 'update']);
        Route::delete('/cms/{id}', [AdminCMSController::class, 'destroy']);
    });
});


