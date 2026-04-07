<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Models\Event;

Route::get('/', function () {
    // Fetch all events, or use paginate(12) if you have many
    $events = Event::orderBy('date', 'asc')->get(); 

    return view('welcome', compact('events'));
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // 1. Custom route for Management Page
    Route::get('/events/display', [EventController::class, 'display'])->name('events.display');
    Route::resource('events', EventController::class);
});

require __DIR__.'/auth.php';
