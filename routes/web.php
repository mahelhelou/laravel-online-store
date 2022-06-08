<?php

use Illuminate\Support\Facades\Route;

// Use controllers
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminHomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Create a new home page route
Route::get('/', function() {
    // return view('home');
    return view('welcome');
});

// Route to users - String
Route::get('/users', function() {
    return 'Welcome to Users!';
});

// Route to user - Array (JSON)
Route::get('/users', function() {
    return ['PHP', 'JavaScript', 'React'];
});

// Route to users - JSON
Route::get('/users', function() {
    return response()->json([
        'name'    => 'Mahmoud',
        'course'    => 'Laravel Beginners to Advanced!',
    ]);
});

// Route to users - Function
Route::get('/users', function() {
    // Redirect /users to homepage
    return redirect('/');
});


// Creating routes from controllers

/**
 * Before Laravel 8
 * Deprecated!
 * Don't use (use) statement to import the controller
 * Don't use the full path of the controller
 */
// Route::get('/products', 'ProductsController@index');

/**
 * Laravel 8 (Also new)
 * Write the full path of the controller
 */
// Route::get('/products', [\App\Http\Controllers\ProductsController::class, 'index']);

/**
 * Laravel 8 (New)
 * Import the controller using (use) statement
 */
Route::get('/products', [ProductsController::class, 'index']);
Route::get('/products/about', [ProductsController::class, 'about']);

/* Route::get('/', function () {
  // return view('welcome');
  $viewData = [];
  $viewData["title"] = "Home Page - Online Store";
  return view('home.index')->with("viewData", $viewData);
}); */

/* Route::get('/about', 'App\Http\Controllers\HomeController@about')->name("home.about"); */

// Refactoring routes (Cleaner: Login is defined inside HomeController)
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');

// Products routes
Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');

// Admin routes
Route::get('/admin', [AdminHomeController::class, 'index'])->name('admin.home.index');