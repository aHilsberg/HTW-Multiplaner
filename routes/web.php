<?php

use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\GroupController;
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
});


Route::middleware('auth')->group(function () {
    Route::post('/friends', [FriendshipController::class, 'store'])->name('friendship.request');
    Route::put('/friends', [FriendshipController::class, 'update'])->name('friendship.accept');
    Route::delete('/friends', [FriendshipController::class, 'destroy'])->name('friendship.remove');

    Route::post('/group', [GroupController::class, 'store'])->name('group.create')->middleware('throttle:3,1');
    Route::patch('/group', [GroupController::class, 'rename'])->name('group.rename');
    Route::put('/group', [GroupController::class, 'update'])->name('group.update');
    Route::delete('/group', [GroupController::class, 'destroy'])->name('group.remove');

    Route::post('/event', [GroupController::class, 'store'])->name('event.create')->middleware('throttle:3,1');
    Route::patch('/event', [GroupController::class, 'rename'])->name('event.rename');
    Route::put('/event', [GroupController::class, 'update'])->name('event.update');
    Route::delete('/event', [GroupController::class, 'destroy'])->name('event.remove');
});

