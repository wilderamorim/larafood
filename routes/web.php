<?php

use Illuminate\Support\Facades\{Auth, Route};
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Admin\{
    CategoryController,
    ProductController,
    PlanController,
    PlanDetailController,
    UserController,
};
use App\Http\Controllers\Admin\ACL\{
    PermissionProfileController,
    PermissionController,
    ProfileController,
    ProfilePlanController,
};

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

Route::prefix('admin')->middleware('auth')->group(function () {
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

    //permissions x profiles
    Route::get('permission-profile/{profile}/permissions', [PermissionProfileController::class, 'permissionsIndex'])->name('permission_profile.permissions.index');
    Route::any('permission-profile/{profile}/permissions/create', [PermissionProfileController::class, 'permissionsCreate'])->name('permission_profile.permissions.create');
    Route::post('permission-profile/{profile}/permissions', [PermissionProfileController::class, 'permissionsStore'])->name('permission_profile.permissions.store');
    Route::delete('permission-profile/{profile}/permissions/{permission}', [PermissionProfileController::class, 'permissionsDestroy'])->name('permission_profile.permissions.destroy');

    Route::get('permission-profile/{permission}/profiles', [PermissionProfileController::class, 'profilesIndex'])->name('permission_profile.profiles.index');
    Route::delete('permission-profile/{permission}/profiles/{profile}', [PermissionProfileController::class, 'profilesDestroy'])->name('permission_profile.profiles.destroy');

    //profiles x plans
    Route::get('profile-plan/{plan}/profiles', [ProfilePlanController::class, 'profilesIndex'])->name('profile_plan.profiles.index');
    Route::any('profile-plan/{plan}/profiles/create', [ProfilePlanController::class, 'profilesCreate'])->name('profile_plan.profiles.create');
    Route::post('profile-plan/{plan}/profiles', [ProfilePlanController::class, 'profilesStore'])->name('profile_plan.profiles.store');
    Route::delete('profile-plan/{plan}/profiles/{profile}', [ProfilePlanController::class, 'profilesDestroy'])->name('profile_plan.profiles.destroy');

    Route::get('profile-plan/{profile}/plans', [ProfilePlanController::class, 'plansIndex'])->name('profile_plan.plans.index');
    Route::delete('profile-plan/{profile}/plans/{plan}', [ProfilePlanController::class, 'plansDestroy'])->name('profile_plan.plans.destroy');

    //products
    Route::any('products/search', [ProductController::class, 'search'])->name('products.search');
    Route::resource('products', ProductController::class);

    //categories
    Route::any('categories/search', [CategoryController::class, 'search'])->name('categories.search');
    Route::resource('categories', CategoryController::class);

    //users
    Route::any('users/search', [UserController::class, 'search'])->name('users.search');
    Route::resource('users', UserController::class);
});

Route::get('/', [SiteController::class, 'index'])->name('site.index');
Route::get('/subscription/{plan}', [SiteController::class, 'subscription'])->name('site.subscription');

Auth::routes(['register' => true]);
