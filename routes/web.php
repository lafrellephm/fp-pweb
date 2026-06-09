<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return match (auth()->user()->role) {
            'admin'    => redirect('/admin/dashboard'),
            'pimpinan' => redirect('/pimpinan/dashboard'),
            default    => redirect('/user/dashboard'),
        };
    }
    return redirect('/login');
});

Route::middleware('auth')->group(function () {

    // User routes
    Route::middleware('role:user')->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', function () {
            return view('user.dashboard');
        })->name('dashboard');
    });

    // Admin routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    });

    // Pimpinan routes
    Route::middleware('role:pimpinan')->prefix('pimpinan')->name('pimpinan.')->group(function () {
        Route::get('/dashboard', function () {
            return view('pimpinan.dashboard');
        })->name('dashboard');
    });
});

require __DIR__.'/auth.php';
