<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Events
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('events.create') }}"
                   class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    + Add Event
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full text-left table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3">#</th>
                            <th class="px-6 py-3">Title</th>
                            <th class="px-6 py-3">Date</th>
                            <th class="px-6 py-3">Time</th>
                            <th class="px-6 py-3">Location</th>
                            <th class="px-6 py-3">Capacity</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                        <tr class="border-t">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $event->title }}</td>
                            <td class="px-6 py-4">{{ $event->date }}</td>
                            <td class="px-6 py-4">{{ $event->time }}</td>
                            <td class="px-6 py-4">{{ $event->location }}</td>
                            <td class="px-6 py-4">{{ $event->capacity ?? 'Unlimited' }}</td>
                            <td class="px-6 py-4">{{ ucfirst($event->status) }}</td>
                            <td class="px-6 py-4 flex gap-2">
                                <a href="{{ route('events.edit', $event) }}"
                                   class="bg-yellow-400 text-black px-3 py-1 rounded">Edit</a>
                                <form action="{{ route('events.destroy', $event) }}" method="POST"
                                      onsubmit="return confirm('Delete?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 text-black px-3 py-1 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-400">
                                No events found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>