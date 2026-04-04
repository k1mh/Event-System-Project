<x-app-layout>
    <div x-data="{ sidebarOpen: true }" class="min-h-screen flex bg-gray-50">
        
        <aside 
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="sidebar fixed inset-y-0 left-0 z-50 transition-transform duration-300 lg:translate-x-0 lg:static shadow-xl"
        >
            <div class="p-6 mb-4 flex items-center border-b border-white/10">
                <img src="{{ asset('image/TechHub_Admin_Logo.png') }}" class="h-10" alt="Logo">
            </div>
            
            <nav class="mt-4">
                <a href="{{ route('events.index') }}" class="sidebar-link">
                    <span class="mr-3 text-lg">🏠</span> Dashboard
                </a>

                <a href="{{ route('events.display') }}" class="sidebar-link active">
                    <span class="mr-3 text-lg">📅</span> Event Management
                </a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            
            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6 lg:px-10">
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 p-2 hover:bg-gray-100 rounded-lg">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <div class="text-gray-500 text-sm font-bold">Event Control Center</div>
            </header>

            <main class="p-6 lg:p-10 overflow-y-auto">
                
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
                    <div>
                        <h2 class="text-3xl font-extrabold text-gray-900">Event Management</h2>
                        <p class="text-gray-500 mt-1">Create, update, or remove events from the system.</p>
                    </div>
                    
                    <a href="{{ route('events.create') }}" class="btn-primary px-8 py-3 rounded-xl shadow-lg flex items-center gap-2">
                        <span class="text-xl">+</span> Add New Event
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-8 rounded shadow-sm flex justify-between">
                        <span>{{ session('success') }}</span>
                        <button class="font-bold" onclick="this.parentElement.remove()">×</button>
                    </div>
                @endif

                <div class="dash-card shadow-2xl border border-gray-100">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="table-header border-b-2 border-gray-50 text-xs uppercase tracking-widest text-blue-600">
                                    <th class="px-6 py-5">Event Title</th>
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
                                        <div class="text-xs text-gray-400">{{ $event->date }}</div>
                                    </td>
                                    
                                    <td class="px-6 py-5 text-gray-600 italic">
                                        {{ $event->location }}
                                    </td>

                                    <td class="px-6 py-5">
                                        <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-md text-xs font-mono">
                                            {{ $event->capacity ?? '∞' }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-5">
                                        <div class="flex justify-end items-center gap-6">
                                            <a href="{{ route('events.edit', $event) }}" class="text-blue-500 font-bold hover:text-blue-700 transition transform hover:scale-110">
                                                Edit
                                            </a>
                                            
                                            <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('⚠️ Are you sure you want to delete this event? This cannot be undone.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 font-bold hover:text-red-700 transition transform hover:scale-110">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="py-20 text-center text-gray-400 italic">
                                        No events found. Click "Add New Event" to get started.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>

        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-cloak class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 lg:hidden"></div>
    </div>
</x-app-layout>