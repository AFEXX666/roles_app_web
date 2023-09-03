<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

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
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Nrmal users routes list
Route::middleware(['auth', 'user-access:user'])->group(function (){

    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

//Admin users routes list
Route::middleware(['auth', 'user-access:admin'])->group(function (){

    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
});

//Manager users routes list
Route::middleware(['auth', 'user-access:manager'])->group(function (){

    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});
