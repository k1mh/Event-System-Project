<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Event
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <form action="{{ route('events.store') }}" method="POST">
                    @csrf

                    {{-- Title --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                               class="mt-1 w-full border rounded px-3 py-2" required>
                        @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="3"
                                  class="mt-1 w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Date & Time --}}
                    <div class="mb-4 grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Date</label>
                            <input type="date" name="date" value="{{ old('date') }}"
                                   class="mt-1 w-full border rounded px-3 py-2" required>
                            @error('date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Time</label>
                            <input type="time" name="time" value="{{ old('time') }}"
                                   class="mt-1 w-full border rounded px-3 py-2" required>
                            @error('time') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Location --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Location</label>
                        <input type="text" name="location" value="{{ old('location') }}"
                               class="mt-1 w-full border rounded px-3 py-2" required>
                        @error('location') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Capacity --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Capacity (optional)</label>
                        <input type="number" name="capacity" value="{{ old('capacity') }}"
                               class="mt-1 w-full border rounded px-3 py-2">
                        @error('capacity') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    {{-- status --}}
                     <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Status</label>

                                <select name="status" class="mt-1 w-full border rounded px-3 py-2" required>
                                    <option value="">-- Select Status --</option>

                                    <option value="upcoming" 
                                        {{ old('status', $event->status) == 'upcoming' ? 'selected' : '' }}>
                                        Upcoming
                                    </option>

                                    <option value="ongoing" 
                                        {{ old('status', $event->status) == 'ongoing' ? 'selected' : '' }}>
                                        On Going
                                    </option>

                                    <option value="completed" 
                                        {{ old('status', $event->status) == 'completed' ? 'selected' : '' }}>
                                        Completed
                                    </option>
                                </select>

                                @error('status') 
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                                @enderror
                            </div>

                    {{-- Buttons --}}
                    <div class="flex gap-3">
                        <button type="submit"
                                class="bg-blue-500 text-gray px-6 py-2 rounded hover:bg-blue-600">
                            Create Event
                        </button>
                        <a href="{{ route('events.index') }}"
                           class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">
                            Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>