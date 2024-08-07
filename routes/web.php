<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DailyTruckingPlanController;
use App\Http\Controllers\DailyTruckingActuallyController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\TruckController;
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
Route::view('/', 'client.index')->name('landing');
Route::view('about', 'client.about')->name('about');

// Login: when user whant to login
Route::group(['prefix' => 'login', 'as' => 'login.'], function () {
    Route::get('/', [AuthController::class, 'formLogin'])->name('form');
    Route::post('/', [AuthController::class, 'login'])->name('submit');
});

// Auth routes
Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    // General: dashboard
    Route::get('/', [AuthController::class, 'dashboard'])->name('dashboard');

    // Admin Routes
    Route::group(['middleware' => 'admin'], function () {
        // User: list all users and edit user
        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('create', [UserController::class, 'create'])->name('create');
            Route::post('create', [UserController::class, 'store'])->name('store');
            Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit');
            Route::post('edit/{id}', [UserController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [UserController::class, 'destroy'])->name('delete');
        });
    });

    // Operation Routes
    Route::group(['middleware' => 'operation'], function () {
        // Client: list all clients and edit client
        Route::group(['prefix' => 'client', 'as' => 'client.'], function () {
            Route::get('/', [ClientController::class, 'index'])->name('index');
            Route::get('create', [ClientController::class, 'create'])->name('create');
            Route::post('create', [ClientController::class, 'store'])->name('store');
            Route::get('edit/{id}', [ClientController::class, 'edit'])->name('edit');
            Route::post('edit/{id}', [ClientController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [ClientController::class, 'destroy'])->name('delete');
        });

        // Shipment: list all shipments and edit shipment
        Route::group(['prefix' => 'shipment', 'as' => 'shipment.'], function () {
            Route::get('/', [ShipmentController::class, 'index'])->name('index');
            Route::get('create', [ShipmentController::class, 'create'])->name('create');
            Route::post('create', [ShipmentController::class, 'store'])->name('store');
            Route::get('edit/{id}', [ShipmentController::class, 'edit'])->name('edit');
            Route::post('edit/{id}', [ShipmentController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [ShipmentController::class, 'delete'])->name('destroy');
        });

        // DTA: list all DTA and edit DTA
        Route::group(['prefix' => 'approval-dta', 'as' => 'dta.approval.'], function () {
            Route::get('/', [DailyTruckingActuallyController::class, 'approval_index'])->name('index');
            Route::get('/{shipment}/show', [DailyTruckingActuallyController::class, 'approval_show'])->name('show');
            Route::get('/{shipment}/show/{dta}', [DailyTruckingActuallyController::class, 'approval_truck'])->name('truck');
            Route::get('/{shipment}/set',  [DailyTruckingActuallyController::class, 'approval_set'])->name('set');
            Route::get('{shipment}/edit/{dta}', [DailyTruckingActuallyController::class, 'approval_edit'])->name('edit');
            Route::post('{shipment}/edit/{dta}', [DailyTruckingActuallyController::class, 'approval_update'])->name('update');
        });
    });

    // Trucking Routes
    Route::group(['middleware' => 'trucking'], function () {
        // Driver: list all drivers and edit driver
        Route::group(['prefix' => 'driver', 'as' => 'driver.'], function () {
            Route::get('/', [DriverController::class, 'index'])->name('index');
            Route::get('create', [DriverController::class, 'create'])->name('create');
            Route::post('create', [DriverController::class, 'store'])->name('store');
            Route::get('edit/{id}', [DriverController::class, 'edit'])->name('edit');
            Route::post('edit/{id}', [DriverController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [DriverController::class, 'delete'])->name('destroy');
        });

        // Truck: list all trucks and edit truck
        Route::group(['prefix' => 'truck', 'as' => 'truck.'], function () {
            Route::get('/', [TruckController::class, 'index'])->name('index');
            Route::get('create', [TruckController::class, 'create'])->name('create');
            Route::post('create', [TruckController::class, 'store'])->name('store');
            Route::get('edit/{id}', [TruckController::class, 'edit'])->name('edit');
            Route::post('edit/{id}', [TruckController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [TruckController::class, 'delete'])->name('destroy');
        });

        // DTP: list all DTP and edit DTP
        Route::group(['prefix' => 'dtp', 'as' => 'dtp.'], function () {
            Route::get('/', [DailyTruckingPlanController::class, 'index'])->name('index');
            Route::get('{shipment}/show', [DailyTruckingPlanController::class, 'show'])->name('show');
            Route::get('{shipment}/approving', [DailyTruckingPlanController::class, 'approving'])->name('approving');
            Route::get('{shipment}/add-truck', [DailyTruckingPlanController::class, 'create'])->name('create');
            Route::post('{shipment}/add-truck', [DailyTruckingPlanController::class, 'store'])->name('store');
            Route::get('{shipment}/edit-truck/{id}', [DailyTruckingPlanController::class, 'edit'])->name('edit');
            Route::post('{shipment}/edit-truck/{id}', [DailyTruckingPlanController::class, 'update'])->name('update');
            Route::delete('{shipment}/delete-truck/{id}', [DailyTruckingPlanController::class, 'delete'])->name('destroy');
        });

        // DTA: list all DTA and edit DTA
        Route::group(['prefix' => 'dta', 'as' => 'dta.'], function () {
            Route::get('/', [DailyTruckingActuallyController::class, 'index'])->name('index');
            Route::get('{shipment}/show', [DailyTruckingActuallyController::class, 'show'])->name('show');
            Route::get('{shipment}/edit/{id}', [DailyTruckingActuallyController::class, 'edit'])->name('edit');
            Route::post('{shipment}/edit/{id}', [DailyTruckingActuallyController::class, 'update'])->name('update');
            Route::get('{shipment}/approving', [DailyTruckingActuallyController::class, 'approving'])->name('approving');
        });
    });

    // Finance Routes
    Route::group(['middleware' => 'finance'], function () {
        // DTP: list all DTP and edit DTP
        Route::group(['prefix' => 'approval-dtp', 'as' => 'dtp.approval.'], function () {
            Route::get('/', [DailyTruckingPlanController::class, 'approval_index'])->name('index');
            Route::get('/{shipment}/show', [DailyTruckingPlanController::class, 'approval_show'])->name('show');
            Route::get('/{shipment}/set',  [DailyTruckingPlanController::class, 'approval_set'])->name('set');
            Route::get('{shipment}/edit-truck/{dtp}', [DailyTruckingPlanController::class, 'approval_edit'])->name('edit');
            Route::post('{shipment}/edit-truck/{dtp}', [DailyTruckingPlanController::class, 'approval_update'])->name('update');
        });

        // Billing: list all billing and edit billing
        Route::group(['prefix' => 'bill', 'as' => 'bill.'], function () {
            Route::get('/', [BillController::class, 'index'])->name('index');
            Route::get('create', [BillController::class, 'create'])->name('create');
            Route::post('create', [BillController::class, 'store'])->name('store');
            Route::get('edit/{id}', [BillController::class, 'edit'])->name('edit');
            Route::post('edit/{id}', [BillController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [BillController::class, 'delete'])->name('destroy');
            Route::get('download/{id}', [BillController::class, 'export'])->name('download');
            Route::get('dtp/{id}', [BillController::class, 'dtp_detail'])->name('dtp.detail');
            Route::get('dta/{id}', [BillController::class, 'dta_detail'])->name('dta.detail');
            Route::get('dta/{id}/truck/{truck}', [BillController::class, 'dta_truck'])->name('dta.truck');
        });
    });

    // Log: list all logs and detail log
    Route::group(['prefix' => 'log', 'as' => 'log.'], function () {
        Route::get('/', [LogController::class, 'index'])->name('index');
    });

    // Logout: when user whant to logout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

// Assets routes: all assets after `assets/` will be handled by this route
Route::get('/assets/{path}', [AssetController::class, 'getFile'])
    ->where('path', '.*')
    ->name('assets');


// Auth routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('{file}', [DailyTruckingActuallyController::class, 'download'])->name('dta.download');
});
