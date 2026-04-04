<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white shadow-xl rounded-3xl overflow-hidden border border-gray-100">
                
                <div class="bg-[#0A2540] p-6 flex items-center gap-4">
                    <div class="p-2 border-2 border-white rounded-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white">Update Event</h2>
                </div>

                <form action="{{ route('events.update', $event) }}" method="POST" class="p-8">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        {{-- Title --}}
                        <div>
                            <label class="form-label-admin">Title</label>
                            <input type="text" name="title" value="{{ old('title', $event->title) }}" class="form-input-admin" placeholder="Event Title" required>
                            @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Description --}}
                        <div>
                            <label class="form-label-admin">Description</label>
                            <textarea name="description" rows="4" class="form-input-admin">{{ old('description', $event->description) }}</textarea>
                            @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Date & Time Grid --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="form-label-admin">Date</label>
                                <input type="date" name="date" value="{{ old('date', \Carbon\Carbon::parse($event->date)->format('Y-m-d')) }}" class="form-input-admin" required>
                                @error('date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="form-label-admin">Time</label>
                                <input type="time" name="time" value="{{ old('time', $event->time) }}" class="form-input-admin" required>
                                @error('time') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        {{-- Location --}}
                        <div>
                            <label class="form-label-admin">Location</label>
                            <input type="text" name="location" value="{{ old('location', $event->location) }}" class="form-input-admin" placeholder="Event Location" required>
                            @error('location') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Capacity & Status Grid --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="form-label-admin">Capacity</label>
                                <input type="number" name="capacity" value="{{ old('capacity', $event->capacity) }}" class="form-input-admin">
                                @error('capacity') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="form-label-admin">Status</label>
                                <select name="status" class="form-input-admin" required>
                                    <option value="upcoming" {{ old('status', $event->status) == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                                    <option value="ongoing" {{ old('status', $event->status) == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                    <option value="completed" {{ old('status', $event->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Bottom Action Buttons --}}
                    <div class="mt-10 flex justify-end gap-4">
                        <a href="{{ route('events.display') }}" class="px-8 py-3 text-gray-500 font-semibold hover:text-gray-700 transition">Cancel</a>
                        <button type="submit" class="bg-[#003465] text-white px-10 py-3 rounded-full font-bold shadow-lg hover:bg-[#002850] transition transform hover:scale-105">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>