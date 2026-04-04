<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
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
=======
use App\Http\Controllers\EventController;

>>>>>>> 7b5b2213eb06e2bc5884d34ab9d3021b76bda39f

Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
// >>> DELETE THE OTHER ROUTE::GET('/DASHBOARD'...) THAT WAS HERE <<<

=======
>>>>>>> 7b5b2213eb06e2bc5884d34ab9d3021b76bda39f
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('events', EventController::class);
});

require __DIR__.'/auth.php';