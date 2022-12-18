<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Guest routes
Route::get('/', function () {
    return view('client.index');
})->name('landing');

Route::get('about', function () {
    return view('client.about');
})->name('about');

// Login: when user whant to login
Route::group(['prefix' => 'login', 'as' => 'login.'], function(){
    Route::get('/', [AuthController::class, 'formLogin'])->name('form');
    Route::post('/', [AuthController::class, 'login'])->name('submit');
});

// Auth routes
Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function(){
    Route::get('/', [AuthController::class, 'dashboard'])->name('dashboard');

    // User: list all users and edit user
    Route::group(['middleware' => 'admin', 'prefix' => 'user', 'as' => 'user.'], function() {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('create', [UserController::class, 'store'])->name('store');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::post('edit/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [UserController::class, 'destroy'])->name('delete');
    });

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
