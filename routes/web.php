<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Event;

// KEEP THIS VERSION (It has the $total, $upcoming, etc.)
Route::get('/dashboard', function () {
    $total = Event::count();
    $upcoming = Event::where('status', 'upcoming')->count();
    $completed = Event::where('status', 'completed')->count();

    $recentEvents = Event::latest()->take(7)->get();

    return view('dashboard', [
        'totalCount' => $total,
        'upcomingCount' => $upcoming,
        'completedCount' => $completed,
        'events' => $recentEvents
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    return view('welcome');
});

// >>> DELETE THE OTHER ROUTE::GET('/DASHBOARD'...) THAT WAS HERE <<<

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';