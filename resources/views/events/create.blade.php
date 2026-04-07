<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white shadow-xl rounded-3xl overflow-hidden border border-gray-100">
                
                <div class="bg-[#0A2540] p-6 flex items-center gap-4">
                    <div class="flex items-center justify-center w-10 h-10 border-2 border-white rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white uppercase tracking-wide">Add Event</h2>
                </div>

                <form action="{{ route('events.store') }}" method="POST" class="p-8">
                    @csrf

                    <div class="space-y-6">
                        {{-- Title --}}
                        <div>
                            <label class="form-label-admin">Title</label>
                            <input type="text" name="title" value="{{ old('title') }}" 
                                   class="form-input-admin" placeholder="Event Title" required>
                            @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Description --}}
                        <div>
                            <label class="form-label-admin">Description</label>
                            <textarea name="description" rows="4" class="form-input-admin" placeholder="Briefly describe the event">{{ old('description') }}</textarea>
                            @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Date & Time Grid --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="form-label-admin">Date</label>
                                <input type="date" name="date" value="{{ old('date') }}" class="form-input-admin" required>
                                @error('date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="form-label-admin">Time</label>
                                <input type="time" name="time" value="{{ old('time') }}" class="form-input-admin" required>
                                @error('time') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        {{-- Location --}}
                        <div>
                            <label class="form-label-admin">Location</label>
                            <input type="text" name="location" value="{{ old('location') }}" 
                                   class="form-input-admin" placeholder="Venue or Online Link" required>
                            @error('location') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Capacity --}}
                        <div>
                            <label class="form-label-admin">Capacity</label>
                            <input type="number" name="capacity" value="{{ old('capacity') }}" 
                                   class="form-input-admin" placeholder="e.g. 100">
                            @error('capacity') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Bottom Action Buttons --}}
                    <div class="mt-10 flex justify-end gap-4">
                        <a href="{{ route('events.display') }}" class="px-8 py-3 text-gray-500 font-semibold hover:text-gray-700 transition">Cancel</a>
                        <button type="submit" class="bg-[#00C896] text-[#0A2540] px-12 py-3 rounded-full font-bold shadow-lg hover:bg-[#00b386] transition transform hover:scale-105">
                            Add
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>