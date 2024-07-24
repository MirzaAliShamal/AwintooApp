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
        Route::get('password', 'password')->name('password');
        Route::post('password/update', 'passwordUpdate')->name('password.update');
    });

});
