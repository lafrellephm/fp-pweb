<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminIncomingLetterController;
use App\Http\Controllers\Admin\AdminOutgoingLetterController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserOutgoingLetterController;
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
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        Route::resource('/outgoing-letters', UserOutgoingLetterController::class)
             ->parameters(['outgoing-letters' => 'id']);
    });

    // Admin routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::patch('/incoming-letters/{id}/status', [AdminIncomingLetterController::class, 'updateStatus'])->name('incoming-letters.status');
        Route::resource('/incoming-letters', AdminIncomingLetterController::class)->parameters(['incoming-letters' => 'id']);

        // Outgoing Letters
        Route::get('/outgoing-letters', [AdminOutgoingLetterController::class, 'index'])->name('outgoing-letters.index');
        Route::get('/outgoing-letters/{id}', [AdminOutgoingLetterController::class, 'show'])->name('outgoing-letters.show');
        Route::get('/outgoing-letters/{id}/process', [AdminOutgoingLetterController::class, 'edit'])->name('outgoing-letters.process');
        Route::put('/outgoing-letters/{id}/process', [AdminOutgoingLetterController::class, 'update'])->name('outgoing-letters.update');
        Route::patch('/outgoing-letters/{id}/sent', [AdminOutgoingLetterController::class, 'markSent'])->name('outgoing-letters.sent');
    });

    // Pimpinan routes
    Route::middleware('role:pimpinan')->prefix('pimpinan')->name('pimpinan.')->group(function () {
        Route::get('/dashboard', function () {
            return view('pimpinan.dashboard');
        })->name('dashboard');
    });
});

require __DIR__.'/auth.php';
