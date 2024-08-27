<?php

use Illuminate\Support\Facades\Route;

Route::get('/migrations', function () {
    $exitCode = Artisan::call('migrate');
    if ($exitCode === 0) {
        return 'Migration ran successfully!';
    } else {
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
        Route::get('information', 'restInfo')->name('restInfo');
        Route::get('appointment', 'appointment')->name('appointment');
        // Route::get('notification', 'notify')->name('notify');
        // Route::get('notification/{id}/read', 'readNotify')->name('read.notify');
    });

});
