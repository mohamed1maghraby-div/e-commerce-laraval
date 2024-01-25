<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Backend\BrandController;
use App\Http\Controllers\API\Backend\ProductController;
use App\Http\Controllers\API\Frontend\ProductCategoryController;
use App\Http\Controllers\API\Backend\ProductCategoryController as BackendProductCategoryController;


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
//middleware('auth:sanctum')
Route::middleware(['api', 'apiCheckPassword'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => ['api', 'apiCheckPassword']], function(){
});
Route::get('categories/{id}/subcategories', [BackendProductCategoryController::class, 'getSubCategoriesOfMainCategory']);
Route::get('/categories', [ProductCategoryController::class, 'index'])->name('frontend.index');
Route::resource('product_categories', BackendProductCategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('brands', BrandController::class);
