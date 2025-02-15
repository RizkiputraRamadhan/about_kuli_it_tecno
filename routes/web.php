<?php

use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientPageController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\SourceCodeController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Client\DashboardController as ClientDashboard;

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

// Authentication Routes
Route::controller(AuthenticatedSessionController::class)->group(function () {
    Route::get('register', 'register');
    Route::post('register', 'storeRegister');
    Route::get('login', 'login')->name('login');
    Route::post('login', 'auth');
    Route::post('google/redirect', 'redirect')->name('google.redirect');
    Route::get('google/callback', 'callback')->name('google.callback');
    Route::get('logout', 'destroy')->name('logout');
});

// Client Page 
Route::name('client.')->controller(ClientPageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/source-code', 'source_code')->name('sources');
    Route::get('/source-code/{slug}', 'detail_source_code')->name('source_detail');
});

// Client Page 
Route::name('client.')->middleware('auth')->controller(ClientPageController::class)->group(function () {
    Route::get('/source-code/payment/{crsf}/{slug}', 'source_payment')->name('source.payment');
    Route::post('/source-code/payment/{crsf}/{slug}', 'payment')->name('payment');
    Route::post('/source-code/payment/voucher/{crsf}/{slug}', 'voucher')->name('voucher');
    Route::get('/download/source/{order_id}', 'download')->name('download.source');
    Route::get('/source-code/invoice/{order_id}', 'invoice')->name('invoice');
});

Route::middleware('auth')->group(function () {

    // sisi user client
    Route::get('/home', [ClientDashboard::class, 'index'])->name('home.index');
    Route::get('/transaction/client', [ClientDashboard::class, 'transaction'])->name('transaction_client.index');
    Route::put('/users/profile/update', [UsersController::class, 'updateAccount'])->name('users.updateAccount');


    // sisi admin
    Route::middleware(isAdmin::class)->group(function () {
        //beranda
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard.index');

        // users routes
        Route::name('users.')->controller(UsersController::class)->group(function () {
            Route::get('/users', 'index')->name('index');
            Route::post('/users', 'store')->name('store');
            Route::get('/users/edit/{id}', 'edit')->name('edit');
            Route::put('/users/update/{id}', 'update')->name('update');
            Route::post('/users/delete/{id}', 'destroy')->name('destroy');
        });

            // Categories Routes
        Route::name('categories.')->controller(CategoriesController::class)->group(function () {
            Route::get('/categories', 'index')->name('index');
            Route::post('/categories', 'store')->name('store');
            Route::get('/categories/edit/{id}', 'edit')->name('edit');
            Route::put('/categories/update/{id}', 'update')->name('update');
            Route::post('/categories/delete/{id}', 'destroy')->name('destroy');
        });

        // Technology Routes
        Route::name('technology.')->controller(TechnologyController::class)->group(function () {
            Route::get('/technology', 'index')->name('index');
            Route::post('/technology', 'store')->name('store');
            Route::get('/technology/edit/{id}', 'edit')->name('edit');
            Route::put('/technology/update/{id}', 'update')->name('update');
            Route::post('/technology/delete/{id}', 'destroy')->name('destroy');
        });

        // Voucher Routes
        Route::name('voucher.')->controller(VoucherController::class)->group(function () {
            Route::get('/voucher', 'index')->name('index');
            Route::post('/voucher', 'store')->name('store');
            Route::get('/voucher/edit/{id}', 'edit')->name('edit');
            Route::put('/voucher/update/{id}', 'update')->name('update');
            Route::post('/voucher/delete/{id}', 'destroy')->name('destroy');
        });

        // Source Codes Admin Routes
        Route::name('source_codes_admin.')->controller(SourceCodeController::class)->group(function () {
            Route::get('/source_codes/admin', 'index')->name('index');
            Route::get('/source_codes/admin/create', 'create')->name('create');
            Route::post('/source_codes/admin', 'store')->name('store');
            Route::get('/source_codes/admin/status/{id}', 'status')->name('status');
            Route::get('/source_codes/admin/step/{step}/{slug}', 'step')->name('step');
            Route::put('/source_codes/admin/update/{slug}', 'update')->name('update');
            Route::get('/source_codes/admin/file/delete/{id}', 'destroy_file')->name('file_destroy');
            Route::get('/source_codes/admin/asset/delete/{id}', 'destroy_asset')->name('asset_destroy');
            Route::post('/source_codes/admin/delete/{id}', 'destroy')->name('destroy');
        });

        // Transaction Routes
        Route::name('transaction.')->controller(TransactionController::class)->group(function () {
            Route::get('/transaction', 'index')->name('index');
            Route::get('/transaction/show/{id}', 'show')->name('show');
            Route::post('/transaction/delete/{id}', 'destroy')->name('destroy');
        });

    });
});
