<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminIncomingLetterController;
use App\Http\Controllers\Admin\AdminOutgoingLetterController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserOutgoingLetterController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AboutController;
Route::get('/', function () {
    if (auth()->check()) {
        return match (auth()->user()->role) {
            'admin'    => redirect('/admin/dashboard'),
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
        Route::get('/outgoing-letters/{id}/print', [UserOutgoingLetterController::class, 'print'])->name('outgoing-letters.print');
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
        Route::get('/outgoing-letters/{id}/approve', [AdminOutgoingLetterController::class, 'reviewApproval'])->name('outgoing-letters.review');
        Route::patch('/outgoing-letters/{id}/approve', [AdminOutgoingLetterController::class, 'approve'])->name('outgoing-letters.approve');
        Route::patch('/outgoing-letters/{id}/reject', [AdminOutgoingLetterController::class, 'reject'])->name('outgoing-letters.reject');
        Route::patch('/outgoing-letters/{id}/sent', [AdminOutgoingLetterController::class, 'markSent'])->name('outgoing-letters.sent');
        Route::get('/outgoing-letters/{id}/print', [AdminOutgoingLetterController::class, 'print'])->name('outgoing-letters.print');
    });

    // Shared notification routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/{id}/read', [NotificationController::class, 'markRead'])->name('notifications.read');

    // Shared about route
    Route::get('/about', [AboutController::class, 'index'])->name('about');
});

require __DIR__.'/auth.php';
