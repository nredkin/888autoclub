<?php

use App\Http\Controllers\ActiveController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClubCardController;
use App\Http\Controllers\ClubCardLevelController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\InvestorPaymentController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProxyController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\UserController;
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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/user', [UserController::class, 'current']);
    Route::get('/roles', [UserController::class, 'getRoles']);

    Route::group(['prefix' => 'users'], function () {
        Route::get('/managers', [UserController::class, 'managersList']);
        Route::get('/admins', [UserController::class, 'adminsList']);
        Route::get('/investors', [UserController::class, 'investorsList']);
        Route::get('/getAllUsers', [UserController::class, 'getAllUsers']);

        Route::get('/', [UserController::class, 'index'])->name('users.list');
        Route::post('/', [UserController::class, 'store']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'delete']);
    });

    Route::group(['prefix' => 'branches'], function () {
        Route::get('/', [BranchController::class, 'list']);
        Route::get('/dict', [BranchController::class, 'dict']);
        Route::post('/', [BranchController::class, 'store']);
        Route::get('/{id}', [BranchController::class, 'show']);
        Route::put('/{id}', [BranchController::class, 'update']);
        Route::delete('/{id}', [BranchController::class, 'delete']);
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'list']);
        Route::get('/dict', [CategoryController::class, 'dict']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::get('/{id}', [CategoryController::class, 'show']);
        Route::put('/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'delete']);
    });

    Route::group(['prefix' => 'clubCardLevels'], function () {
        Route::get('/', [ClubCardLevelController::class, 'list']);
        Route::get('/dict', [ClubCardLevelController::class, 'dict']);
        Route::get('/{id}', [ClubCardLevelController::class, 'show']);
    });

    Route::group(['prefix' => 'clubCards'], function () {
        Route::get('/{clientId}', [ClubCardController::class, 'index']);
        Route::post('/', [ClubCardController::class, 'store']);
        Route::get('/{id}', [ClubCardController::class, 'show']);
        Route::put('/{id}', [ClubCardController::class, 'update']);
        Route::delete('/{id}', [ClubCardController::class, 'delete']);
    });

    Route::group(['prefix' => 'cars'], function () {
        Route::get('/', [CarController::class, 'list']);
        Route::get('/dict', [CarController::class, 'dict']);
        Route::post('/', [CarController::class, 'store']);
        Route::get('/{id}', [CarController::class, 'show']);
        Route::put('/{id}', [CarController::class, 'update']);
        Route::delete('/{id}', [CarController::class, 'delete']);
    });


    Route::get('/', [IndexController::class, 'index'])->name('dashboard');
});

Auth::routes();
