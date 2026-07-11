<?php

use App\Http\Controllers\RoutingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ImageServeController;
use App\Http\Controllers\Frontend\ProductFEController;
use App\Http\Controllers\Frontend\EnquiryFEController;
use App\Http\Controllers\Frontend\ContactController;
require __DIR__ . '/auth.php';

// Route::get('/', function () {
//     return view('frontend.index'); // create resources/views/dashboard.blade.php
// });




// Serves images directly from storage/app/public — no symlink needed
Route::get('/img/{path}', [ImageServeController::class, 'serve'])
    ->where('path', '.*')
    ->name('img.serve');

Route::get('/', [HomeController::class, 'index']);


// Enquiry form submission
Route::post('/enquiry', [EnquiryFEController::class, 'store'])->name('enquiries.store');

// Single product page
Route::get('/product/{slug}', [ProductFEController::class, 'show'])->name('product.show');
Route::get('/products', [ProductFEController::class, 'index'])->name('products.index');

// Route::get('/', function () {
//     return view('frontend.index'); // create resources/views/dashboard.blade.php
// });

// Route::get('/products', function () {
//     return view('frontend.grid'); // create resources/views/dashboard.blade.php
// });


// Route::get('/product', function () {
//     return view('frontend.product'); // create resources/views/dashboard.blade.php
// });

Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('', [DashboardController::class, 'index'])->name('dashboard');
    //admin
    Route::resource('users', UserController::class);

    //customer
    Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::delete('customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy'); // Delete customer

    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('products', ProductController::class);
    Route::resource('enquiries', EnquiryController::class)
        ->only(['index', 'update', 'destroy']);
});



Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
    // Route::get('', [RoutingController::class, 'index'])->name('root');
    Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
    Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
    Route::get('{any}', [RoutingController::class, 'root'])->name('any');
});


Route::get('/login', function () {
    return view('auth.signin');
})->name('login');

// Login action
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
