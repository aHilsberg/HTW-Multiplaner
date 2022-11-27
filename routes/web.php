<?php

use App\Http\Controllers\FriendshipController;
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
});

