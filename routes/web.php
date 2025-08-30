<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){ return redirect()->route('dashboard'); });

Route::middleware('guest')->group(function(){
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:admin')->group(function () {
        Route::resource('clients', ClientController::class)->except(['index', 'show']);
        Route::resource('invoices', InvoiceController::class)->except(['index', 'show']);
    });

    Route::middleware('role:admin,user')->group(function () {
        Route::resource('clients', ClientController::class)->only(['index', 'show']);
        Route::resource('invoices', InvoiceController::class)->only(['index', 'show']);
        Route::get('invoices/{invoice}/pdf', [InvoiceController::class,'pdf'])->name('invoices.pdf');
    });
});
