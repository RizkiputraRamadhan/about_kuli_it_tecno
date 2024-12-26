<?php

use App\Http\Controllers\Admin\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\SourceCodeController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\LandingPage;
use App\Http\Middleware\isAdmin;

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

Route::get('/', [LandingPage::class, 'home']);
Route::get('/source-code', [LandingPage::class, 'source_code']);
Route::get('/source-code/{slug}', [LandingPage::class, 'detail_source_code']);

Route::get('register', [AuthenticatedSessionController::class, 'register']);
Route::post('register', [AuthenticatedSessionController::class, 'storeRegister']);
Route::get('login', [AuthenticatedSessionController::class, 'login']);
Route::post('login', [AuthenticatedSessionController::class, 'auth']);
Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::middleware(isAdmin::class)->group(function () {
        //beranda
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard.index');
        //users
        Route::get('/users', [UsersController::class, 'index'])->name('users.index');
        Route::post('/users', [UsersController::class, 'store'])->name('users.store');
        Route::get('/users/edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
        Route::put('/users/update/{id}', [UsersController::class, 'update'])->name('users.update');
        Route::post('/users/delete/{id}', [UsersController::class, 'destroy'])->name('users.destroy');

        //categories
        Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store');
        Route::get('/categories/edit/{id}', [CategoriesController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/update/{id}', [CategoriesController::class, 'update'])->name('categories.update');
        Route::post('/categories/delete/{id}', [CategoriesController::class, 'destroy'])->name('categories.destroy');

        //categories
        Route::get('/technology', [TechnologyController::class, 'index'])->name('technology.index');
        Route::post('/technology', [TechnologyController::class, 'store'])->name('technology.store');
        Route::get('/technology/edit/{id}', [TechnologyController::class, 'edit'])->name('technology.edit');
        Route::put('/technology/update/{id}', [TechnologyController::class, 'update'])->name('technology.update');
        Route::post('/technology/delete/{id}', [TechnologyController::class, 'destroy'])->name('technology.destroy');

        //categories
        Route::get('/source_codes/admin', [SourceCodeController::class, 'index'])->name('source_codes_admin.index');
        Route::get('/source_codes/admin/create', [SourceCodeController::class, 'create'])->name('source_codes_admin.create');
        Route::post('/source_codes/admin', [SourceCodeController::class, 'store'])->name('source_codes_admin.store');
        Route::get('/source_codes/admin/edit/{id}', [SourceCodeController::class, 'edit'])->name('source_codes_admin.edit');
        Route::put('/source_codes/admin/update/{id}', [SourceCodeController::class, 'update'])->name('source_codes_admin.update');
        Route::post('/source_codes/admin/delete/{id}', [SourceCodeController::class, 'destroy'])->name('source_codes_admin.destroy');

    });
});
