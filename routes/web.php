<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GetFileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Auth::routes();
Route::get('files', GetFileController::class)->name('get-file');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function () {
    Route::resource("Category", CategoryController::class);
    Route::resource("Product", ProductController::class);
    
});
// Add a route for image deletion
Route::delete('/delete-image/{image}', [ProductController::class, 'deleteImage'])->name('delete.image');