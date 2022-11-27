<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\VotingController;
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
    Route::get('/', function () {
        return Inertia::render('ownTimetable', [
        ]);
    })->name('home');

    Route::get('/appointments', [AppointmentController::class, 'index'])->name('lookup');
});


Route::middleware('auth')->group(function () {
    Route::post('/friends', [FriendshipController::class, 'store'])->name('friendship.request');
    Route::put('/friends', [FriendshipController::class, 'update'])->name('friendship.accept');
    Route::delete('/friends', [FriendshipController::class, 'destroy'])->name('friendship.remove');

    Route::post('/group', [GroupController::class, 'store'])->name('group.create')->middleware('throttle:3,1');
    Route::patch('/group', [GroupController::class, 'rename'])->name('group.rename');
    Route::put('/group', [GroupController::class, 'update'])->name('group.update');
    Route::delete('/group', [GroupController::class, 'destroy'])->name('group.remove');

    Route::post('/event', [EventController::class, 'store'])->name('event.create')->middleware('throttle:3,1');
    Route::patch('/event', [EventController::class, 'rename'])->name('event.rename');
    Route::put('/event', [EventController::class, 'update'])->name('event.update');
    Route::delete('/event', [EventController::class, 'destroy'])->name('event.remove');

    Route::get('/module', [ModuleController::class, 'search'])->name('module.search');
    Route::get('/exam', [ExamController::class, 'search'])->name('exam.search');

    Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.create');
    Route::patch('/appointment', [AppointmentController::class, 'rename'])->name('appointment.rename');
    Route::put('/appointment', [AppointmentController::class, 'update'])->name('appointment.update');
    Route::delete('/appointment', [AppointmentController::class, 'destroy'])->name('appointment.remove');


    Route::post('/vote', [VotingController::class, 'update'])->name('event.vote');
    // possible get for free space
});

