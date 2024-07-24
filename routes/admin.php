<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Auth')->group(function () {
    Route::controller('LoginController')->group(function () {
        Route::get('/', 'showLoginForm')->name('login');
        Route::post('/', 'login')->name('login');
        Route::get('logout', 'logout')->name('logout');
    });
});

Route::middleware('auth')->group(function () {
    Route::controller('AdminController')->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
    });

    // Notification
    Route::controller('NotificationController')->name('notify.')->group(function () {
        Route::get('/notify', 'index')->name('index');
        Route::delete('delete/{id}/notify', 'destroy')->name('destroy');
    });

    Route::get('/command', function () {
    Artisan::call('notify:expiring-passports');
    Artisan::call('notify:expiring-id');
    Artisan::call('notify:expiring-insurance');
    Artisan::call('notify:expiring-driver');
    Artisan::call('notify:expiring-police');

    return response()->json([
        'status' => 'success',
        'message' => 'Command executed successfully!',
    ]);
});

    // User
    Route::controller('UserController')->name('user.')->group(function () {
        Route::get('users', 'index')->name('index');
        Route::get('admins', 'indexAdmin')->name('indexAdmin');
        Route::get('add/user', 'create')->name('create');
        Route::post('add/user', 'store')->name('store');
        Route::get('edit/{id}/user', 'edit')->name('edit');
        Route::put('update/{id}/user', 'update')->name('update');
        Route::delete('delete/{id}/user', 'destroy')->name('destroy');
        Route::get('profile', 'profile')->name('profile');
        Route::put('profile', 'profileUpdate')->name('profile.update');
        Route::get('password', 'password')->name('password');
        Route::post('password', 'passwordUpdate')->name('password.update');
    });

    // Job
    Route::controller('JobController')->name('job.')->group(function () {
        Route::get('jobs', 'index')->name('index');
        Route::get('add/job', 'create')->name('create');
        Route::post('add/job', 'store')->name('store');
        Route::get('edit/{id}/job', 'edit')->name('edit');
        Route::put('update/{id}/job', 'update')->name('update');
        Route::delete('delete/{id}/job', 'destroy')->name('destroy');
    });

    // Rest Information 
    Route::controller('RestInformationController')->name('info.')->group(function () {
        Route::get('informations', 'index')->name('index');
        Route::post('info/import', 'import')->name('import');
        Route::get('add/information', 'create')->name('create');
        Route::post('add/information', 'store')->name('store');
        Route::get('edit/{id}/information', 'edit')->name('edit');
        Route::put('update/{id}/information', 'update')->name('update');
        Route::delete('delete/{id}/information', 'destroy')->name('destroy');
    });

    // Client 
    Route::controller('ClientController')->name('client.')->group(function () {
        Route::get('clients', 'index')->name('index');
        Route::post('clients/import', 'import')->name('import');
        Route::get('search/clients', 'search')->name('search');
        Route::get('add/client', 'create')->name('create');
        Route::post('add/client', 'store')->name('store');
        Route::get('edit/{id}/client', 'edit')->name('edit');
        Route::put('update/{id}/client', 'update')->name('update');
        Route::delete('delete/{id}/client', 'destroy')->name('destroy');
    });

    // Payment 
    Route::controller('PaymentController')->name('payment.')->group(function () {
        Route::get('invoice/{id}', 'generateInvoice')->name('invoice');
        Route::get('confirm-report', 'confirmReport')->name('confirm');
        Route::get('payments', 'index')->name('index');
        Route::get('add/payment', 'create')->name('create');
        Route::post('add/payment', 'store')->name('store');
        Route::get('edit/{id}/payment', 'edit')->name('edit');
        Route::put('update/{id}/payment', 'update')->name('update');
        Route::delete('delete/{id}/payment', 'destroy')->name('destroy');
        Route::get('/client-info/{id}', 'getClientInfo')->name('info');
    });

    // Report
    Route::controller('ReportController')->name('report.')->group(function () {
        Route::get('reports', 'index')->name('index');
        Route::post('confirm-report/', 'confirmReport')->name('confirm');
        Route::post('contract-report/', 'contractReport')->name('contract');
        Route::post('loi-report/', 'loiReport')->name('loi');
        Route::post('rpt-application/', 'rptApplication')->name('rptApplication');
    });

    // General Setting
    Route::controller('GeneralSettingController')->name('setting.')->group(function () {
        Route::get('general/setting', 'index')->name('index');
        Route::post('general-setting', 'update')->name('update');
    });
});