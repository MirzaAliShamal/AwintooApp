<?php

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

Route::get('/migrations', function () {
    // Call the Artisan migrate command
    $exitCode = Artisan::call('migrate');

    // Check the exit code
    if ($exitCode === 0) {
        // Migration ran successfully
        return 'Migration ran successfully!';
    } else {
        // Migration failed
        return 'Migration failed. Exit code: ' . $exitCode;
    }
});

Route::namespace('Front\Auth')->group(function () {
    Route::controller('LoginController')->group(function () {
        Route::get('/', 'showLoginForm')->name('login');
        Route::post('/', 'login')->name('login');
        Route::get('/register', 'showRegisterForm')->name('register');
        Route::post('/register/save', 'store')->name('register.store');
        Route::get('logout', 'logout')->name('logout');
    });
});

Route::namespace('Front')->middleware('client')->name('front.')->group(function () {
    Route::controller('ClientController')->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('rest-information', 'restInfo')->name('restInfo');
        Route::get('notification', 'notify')->name('notify');
        Route::get('notification/{id}/read', 'readNotify')->name('read.notify');
    });

});
