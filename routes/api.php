<?php

use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\MenuListController;
use App\Http\Controllers\OrderController;
use App\Models\MenuCategory;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/categorys', [MenuCategoryController::class, 'index']);
Route::get('/category/first', [MenuCategoryController::class, 'default']);
Route::get('/category/{id}', [MenuCategoryController::class, 'show']);
Route::get('/menu/{id}', [MenuListController::class, 'show']);
Route::get('/menu/{id}/total', [MenuListController::class, 'totalRaw']);
Route::post('/save/order', [OrderController::class, 'store']);
