<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectorController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

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

Route::controller(CompanyController::class)->group(function () {
    Route::prefix('/companies')->group(function () {
        Route::get('', 'list');
        Route::post('', 'create');
        Route::get('/{id}', 'get');
        Route::post('/{id}', 'update');
        Route::post('/{id}/delete', 'delete');
    });
});

Route::controller(MarketController::class)->group(function () {
    Route::prefix('/markets')->group(function () {
        Route::get('', 'list');
        Route::post('', 'create');
        Route::get('/{id}', 'get');
        Route::post('/{id}', 'update');
        Route::post('/{id}/delete', 'delete');
    });
});

Route::controller(CategoryController::class)->group(function () {
    Route::prefix('/categories')->group(function () {
        Route::get('', 'list');
        Route::post('', 'create');
        Route::get('/{id}', 'get');
        Route::post('/{id}', 'update');
        Route::post('/{id}/delete', 'delete');
    });
});

Route::controller(ProductController::class)->group(function () {
    Route::prefix('/products')->group(function () {
        Route::get('', 'list');
        Route::post('', 'create');
        Route::get('/{id}', 'get');
        Route::post('/{id}', 'update');
        Route::post('/{id}/delete', 'delete');
    });
});

Route::controller(CollectorController::class)->group(function () {
    Route::prefix('/collected-data')->group(function () {
        Route::get('', 'list');
        Route::post('', 'create');
        Route::get('/{id}', 'get');

        Route::get('/{id}/products', 'getProducts');
        Route::POST('/{id}/products/{productId}/delete', 'deleteProduct');
        Route::POST('/{id}/products', 'addProduct');

        Route::post('/{id}', 'update');
        Route::post('/{id}/delete', 'delete');
    });
});

Route::controller(ReportController::class)->group(function () {
    Route::prefix('/reports')->group(function () {
        Route::post('/merch/generate', 'generateMerchReport');
    });
});

