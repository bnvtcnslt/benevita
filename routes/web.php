<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
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
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/services', [FrontendController::class, 'services'])->name('services');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
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


        Route::resource('client', ClientController::class);
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

/*End*/


/*Route Storage*/
Route::get('storage/images/{filename}', function ($filename) {
    $path = storage_path('app/public/images/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->name('storage/images');

