<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\VotingController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/', [AppointmentController::class, 'index'])->name('home');
    Route::get('/search', [AppointmentController::class, 'search'])->name('lookup');
});


Route::middleware('auth')->group(function () {
    Route::prefix('friends')->group(function () {
        Route::post('', [FriendshipController::class, 'store'])->name('friendship.request');
        Route::put('', [FriendshipController::class, 'update'])->name('friendship.accept');
        Route::delete('', [FriendshipController::class, 'destroy'])->name('friendship.remove');
    });

    Route::prefix('group')->group(function () {
        Route::post('', [GroupController::class, 'store'])->name('group.create')->middleware('throttle:3,1');
        Route::patch('', [GroupController::class, 'rename'])->name('group.rename');
        Route::put('', [GroupController::class, 'update'])->name('group.update');
        Route::delete('', [GroupController::class, 'destroy'])->name('group.remove');
    });

    Route::prefix('event')->group(function () {
        Route::post('', [EventController::class, 'store'])->name('event.create')->middleware('throttle:3,1');
        Route::patch('', [EventController::class, 'rename'])->name('event.rename');
        Route::put('', [EventController::class, 'update'])->name('event.update');
        Route::delete('', [EventController::class, 'destroy'])->name('event.remove');
    });

    Route::get('/module', [ModuleController::class, 'search'])->name('module.search');
    Route::get('/exam', [ExamController::class, 'search'])->name('exam.search');

    Route::prefix('appointment')->group(function () {
        Route::post('', [AppointmentController::class, 'store'])->name('appointment.create');
        Route::patch('', [AppointmentController::class, 'rename'])->name('appointment.rename');
        Route::put('', [AppointmentController::class, 'update'])->name('appointment.update');
        Route::delete('', [AppointmentController::class, 'destroy'])->name('appointment.remove');
    });

    Route::post('/vote', [VotingController::class, 'update'])->name('event.vote');
    // possible get for free space
});

