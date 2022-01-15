<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\PlanDetailController;

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

Route::prefix('admin')->group(function () {
    //dashboard
    Route::get('/', [PlanController::class, 'index'])->name('admin.index');

    //plans
    Route::any('plans/search', [PlanController::class, 'search'])->name('plans.search');
    Route::get('plans', [PlanController::class, 'index'])->name('plans.index');
    Route::get('plans/create', [PlanController::class, 'create'])->name('plans.create');
    Route::post('plans', [PlanController::class, 'store'])->name('plans.store');
    Route::get('plans/{plan}', [PlanController::class, 'show'])->name('plans.show');
    Route::get('plans/{plan}/edit', [PlanController::class, 'edit'])->name('plans.edit');
    Route::put('plans/{plan}', [PlanController::class, 'update'])->name('plans.update');
    Route::delete('plans/{plan}', [PlanController::class, 'destroy'])->name('plans.destroy');

    //plan details
    Route::get('plans/{plan}/details', [PlanDetailController::class, 'index'])->name('plan_details.index');
    Route::get('plans/{plan}/details/create', [PlanDetailController::class, 'create'])->name('plan_details.create');
    Route::post('plans/{plan}/details', [PlanDetailController::class, 'store'])->name('plan_details.store');
    Route::get('plans/{plan}/details/{detail}', [PlanDetailController::class, 'show'])->name('plan_details.show');
    Route::get('plans/{plan}/details/{detail}/edit', [PlanDetailController::class, 'edit'])->name('plan_details.edit');
    Route::put('plans/{plan}/details/{detail}', [PlanDetailController::class, 'update'])->name('plan_details.update');
    Route::delete('plans/{plan}/details/{detail}', [PlanDetailController::class, 'destroy'])->name('plan_details.destroy');

    //profiles
    Route::any('profiles/search', [ProfileController::class, 'search'])->name('profiles.search');
    Route::resource('profiles', ProfileController::class);

    //permissions
    Route::any('permissions/search', [PermissionController::class, 'search'])->name('permissions.search');
    Route::resource('permissions', PermissionController::class);
});

Route::get('/', function () {
    return view('welcome');
});
