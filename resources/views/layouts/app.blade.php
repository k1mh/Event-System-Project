<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'TechHub') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Sidebar Core */
        .sidebar { background-color: #003465 !important; color: white; }
        .sidebar-link {
            display: flex; align-items: center; padding: 1rem 1.5rem;
            color: rgba(255, 255, 255, 0.7); transition: all 0.3s ease;
            border-left: 4px solid transparent; text-decoration: none;
        }
        .sidebar-link:hover { background-color: rgba(255, 255, 255, 0.05); color: #ffffff; }
        .sidebar-link:hover i { color: #00C896; transform: scale(1.1); }
        .sidebar-link.active { background-color: rgba(255, 255, 255, 0.1); color: #ffffff; border-left-color: #00C896; }
        .sidebar-link.active i { color: #00C896; }
    </style>
</head>
<body class="font-sans antialiased">
    <div x-data="{ sidebarOpen: true }" class="min-h-screen flex bg-gray-50">
        
        <aside 
            :class="sidebarOpen ? 'w-64' : 'w-20'"
            class="sidebar h-screen sticky top-0 z-50 transition-all duration-300 ease-in-out flex flex-col shadow-xl overflow-hidden"
        >
            <div class="p-6 mb-4 flex items-center justify-center border-b border-white/10 h-16 relative">
                <template x-if="sidebarOpen">
                    <img src="{{ asset('image/TechHub_White_Logo.png') }}" class="h-8 mx-auto object-contain" alt="Logo">
                </template>
                <template x-if="!sidebarOpen">
                    <span class="text-white font-bold text-xl">TH</span>
                </template>
            </div>
            
            <nav class="mt-4 flex-1">
                <a href="{{ route('events.index') }}" 
                   class="sidebar-link {{ request()->routeIs('events.index') ? 'active' : '' }}">
                    <i class="fa-solid fa-house text-lg min-w-[35px] text-center"></i>
                    <span x-show="sidebarOpen" class="ml-3 whitespace-nowrap">Dashboard</span>
                </a>

                <a href="{{ route('events.display') }}" 
                   class="sidebar-link {{ request()->routeIs('events.display') ? 'active' : '' }}">
                    <i class="fa-solid fa-calendar-days text-lg min-w-[35px] text-center"></i>
                    <span x-show="sidebarOpen" class="ml-3 whitespace-nowrap">Event Management</span>
                </a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            @include('layouts.navigation')

            <main class="p-6 lg:p-10 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>