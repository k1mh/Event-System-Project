<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<x-app-layout>
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900">Event Management</h2>
            <p class="text-gray-500 mt-1">Create, update, or remove events from the system.</p>
        </div>
        
        <a href="{{ route('events.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl shadow-lg flex items-center gap-2 transition-all">
            <i class="fa-solid fa-plus"></i> Add New Event
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-8 rounded shadow-sm flex justify-between items-center">
            <div class="flex items-center">
                <i class="fa-solid fa-circle-check mr-3"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button class="font-bold text-xl" onclick="this.parentElement.remove()">&times;</button>
        </div>
    @endif

    <div class="shadow-2xl border border-gray-100 bg-white rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-xs uppercase tracking-widest text-blue-600 font-bold">
                        <th class="px-6 py-5">Event Details</th>
                        <th class="px-6 py-5">Location</th>
                        <th class="px-6 py-5">Capacity</th>
                        <th class="px-6 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($events as $event)
                    <tr class="hover:bg-gray-50/80 transition-all duration-200">
                        <td class="px-6 py-5">
                            <div class="font-bold text-gray-900">{{ $event->title }}</div>
                            <div class="text-xs text-gray-400 flex items-center mt-1">
                                <i class="fa-regular fa-clock mr-1"></i> {{ $event->date }}
                            </div>
                        </td>
                        
                        <td class="px-6 py-5 text-gray-600">
                            <div class="flex items-center">
                                <i class="fa-solid fa-location-dot mr-2 text-gray-400"></i>
                                {{ $event->location }}
                            </div>
                        </td>

                        <td class="px-6 py-5">
                            <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-md text-xs font-mono font-bold">
                                {{ $event->capacity ?? '∞' }}
                            </span>
                        </td>

                        <td class="px-6 py-5">
                            <div class="flex justify-end items-center gap-3">
                                
                                <a href="{{ route('events.edit', $event) }}" 
                                class="inline-flex items-center justify-center text-blue-500 hover:bg-blue-50 p-2 rounded-lg transition-colors" 
                                title="Edit Event">
                                    <i class="fa-solid fa-pen-to-square text-lg leading-none"></i>
                                </a>
                                
                                <form action="{{ route('events.destroy', $event) }}" 
                                    method="POST" 
                                    onsubmit="return confirm('⚠️ Are you sure?')"
                                    class="inline-block m-0 p-0"> @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center justify-center text-red-500 hover:bg-red-50 p-2 rounded-lg transition-colors" 
                                            title="Delete Event">
                                        <i class="fa-solid fa-trash-can text-lg leading-none"></i>
                                    </button>
                                </form>
                                
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-20 text-center">
                            <div class="text-gray-400 flex flex-col items-center">
                                <i class="fa-solid fa-calendar-xmark text-4xl mb-3"></i>
                                <p class="italic">No events found in the database.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>