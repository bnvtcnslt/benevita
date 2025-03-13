<?php

use App\Http\Controllers\AuthController;
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

/*Route FrontEnd*/
Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/about', function () {
    return view('frontend.about');
});

Route::get('/services', function () {
    return view('frontend.services');
});

Route::get('/contact', function () {
    return view('frontend.contact');
});
/*End*/

Route::get('/login',[AuthController::class, 'index'])->name('auth.index');
Route::post('/login',[AuthController::class, 'verify'])->name('auth.verify');

Route::group(['middleware' => ['guest']], function () {
    Route::prefix('password')->group(function () {
        // Forgot Password
        Route::get('/forgot', [AuthController::class, 'forgotPassword'])->name('password.request');
        Route::post('/forgot', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
        // Reset Password
        Route::get('/reset/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');
        Route::post('/reset/{token}', [AuthController::class, 'updatePassword'])->name('password.update');
    });
});

Route::group(['middleware' => ['auth:user']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

/*End*/
