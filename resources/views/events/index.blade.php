<x-app-layout>
    <div x-data="{ sidebarOpen: true }" class="min-h-screen flex bg-gray-50">
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="sidebar fixed inset-y-0 left-0 z-50 transition-transform duration-300 lg:translate-x-0 lg:static shadow-xl">
            <div class="p-6 mb-4 flex items-center border-b border-white/10">
                <img src="{{ asset('image/TechHub_Admin_Logo.png') }}" class="h-10" alt="Logo">
            </div>
            <nav class="mt-4">
                <a href="{{ route('events.index') }}" class="sidebar-link active"><span>🏠</span> Dashboard</a>
                <a href="{{ route('events.display') }}" class="sidebar-link"><span>📅</span> Event Management</a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6 lg:px-10">
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 p-2 hover:bg-gray-100 rounded-lg">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <div class="text-gray-500 text-sm">Welcome, <span class="font-bold text-gray-800">{{ Auth::user()->name }}</span></div>
            </header>

            <main class="p-6 lg:p-10">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Dashboard</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
                    <div class="dash-card"><p class="text-gray-500 text-sm uppercase mb-2">Total Events</p><h3 class="stat-number">{{ $events->count() }}</h3></div>
                    <div class="dash-card"><p class="text-gray-500 text-sm uppercase mb-2">Upcoming</p><h3 class="stat-number text-green-500">{{ $events->where('status', 'upcoming')->count() }}</h3></div>
                    <div class="dash-card"><p class="text-gray-500 text-sm uppercase mb-2">Completed</p><h3 class="stat-number text-red-500">{{ $events->where('status', 'completed')->count() }}</h3></div>
                </div>

                <div class="dash-card shadow-lg">
                    <h3 class="text-blue-600 font-bold text-xl mb-6 uppercase tracking-widest">Recent Events</h3>
                    <table class="w-full text-left">
                        <thead class="table-header border-b-2 border-gray-50">
                            <tr><th class="px-4 py-4">Title</th><th class="px-4 py-4">Date</th><th class="px-4 py-4">Status</th></tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($events->take(5) as $event)
                            <tr>
                                <td class="px-4 py-5 font-medium text-gray-800">{{ $event->title }}</td>
                                <td class="px-4 py-5 text-gray-500">{{ $event->date }}</td>
                                <td class="px-4 py-5"><span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $event->status == 'upcoming' ? 'text-green-500 bg-green-50' : 'text-red-500 bg-red-50' }}">{{ $event->status }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>