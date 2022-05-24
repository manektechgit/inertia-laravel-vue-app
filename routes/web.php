<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\Backend\RoleController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [FrontController::class, 'index']);

Route::group(['prefix' => 'admin', 'middleware' => 'prevent-back-history'], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('admin/login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/', [DashboardController::class, 'index']);
        Route::get('/logout', [LoginController::class, 'logout']);

        // User Routes
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/users/create', [UserController::class, 'create']);
        Route::post('/users', [UserController::class, 'store']);
        Route::get('/users/{id}', [UserController::class, 'show']);
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->middleware('admin');
        Route::post('/users/{id}', [UserController::class, 'update'])->middleware('admin');
        Route::get('/users/{id}/delete', [UserController::class, 'destroy'])->middleware('admin');

        // Role Routes
        Route::get('/roles', [RoleController::class, 'index'])->middleware('admin');
        Route::get('/roles/create', [RoleController::class, 'create'])->middleware('admin');
        Route::post('/roles', [RoleController::class, 'store'])->middleware('admin');
        Route::get('/roles/{id}', [RoleController::class, 'show'])->middleware('admin');
        Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->middleware('admin');
        Route::post('/roles/{id}', [RoleController::class, 'update'])->middleware('admin');
        Route::get('/roles/{id}/delete', [RoleController::class, 'destroy'])->middleware('admin');
    });
});
