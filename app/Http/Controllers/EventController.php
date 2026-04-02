<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function index()
    {
        $events = Event::latest()->get();
        return view('events.index', compact('events'));
    }


    public function create()
    {
        return view('events.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'date'        => 'required|date',
            'time'        => 'required',
            'location'    => 'required|string|max:255',
            'capacity'    => 'nullable|integer',
        ]);

        Event::create([
            'title'       => $request->title,
            'description' => $request->description,
            'date'        => $request->date,
            'time'        => $request->time,
            'location'    => $request->location,
            'capacity'    => $request->capacity,
            'status'      => 'upcoming',   
            'user_id'     => auth()->id(), 
        ]);

        return redirect()->route('events.index')
                         ->with('success', 'Event created successfully!');
    }


    public function show(Event $event) 
    {
        return view('events.show', compact('event'));
    }


    public function edit(Event $event) 
    {
     
    }


    public function update(Request $request, Event $event) 
    {
     
    }

 
    public function destroy(Event $event) 
    {
        $event->delete();

        return redirect()->route('events.index')
                         ->with('success', 'Event deleted successfully!');
    }
}
