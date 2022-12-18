<?php

use App\Http\Controllers\AuthController;
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
Route::middleware(['auth'])->group(function(){
    Route::get('dashboard', function () {
        return view('auth.dashboard');
    })->name('dashboard');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
