
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>TechHub | Events</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white antialiased">

    <nav class="flex items-center justify-between px-16 py-6 bg-white shadow-sm sticky top-0 z-50">
        <div class="flex items-center">
            <img src="{{ asset('image/TechHub_Logo .png') }}" class="h-10 w-auto" alt="Logo">
        </div>
        <div class="hidden sm:flex space-x-10">
            <a href="/" class="text-sm font-medium text-gray-700 hover:text-secondary">Home</a>
            <a href="#event" class="text-sm font-medium text-gray-700 hover:text-secondary">Events</a>
        </div>
    </nav>

    <header class="relative h-[550px] w-full overflow-hidden flex items-center">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 z-10 opacity-80" style="background-color: #0A2540; mix-blend-mode: multiply;"></div>
            <img src="https://images.tech.co/wp-content/uploads/2024/01/22094704/EPN_0539-3-1-e1705934863400.jpg" 
                 class="w-full h-full object-cover" alt="Hero Background">
        </div>

        <div class="relative z-20 px-16 max-w-4xl text-white">
            <h1 class="text-5xl font-bold leading-tight mb-6">
                Manage & Discover <br> Events Easily
            </h1>
            <p class="text-lg text-[#F5F7FA] mb-4 max-w-xl leading-relaxed opacity-90">
                Explore upcoming events, manage schedules, and stay organized with our modern event system.
            </p>
            <p class="text-sm mb-6 font-medium">Or manage events:</p>
            
            <a href="{{ route('login') }}" class="btn-primary !w-56 !rounded-full !py-3 !mt-0 !normal-case tracking-normal text-center inline-block btn-glow">
                Access as Admin
            </a>
        </div>
    </header>

    <section class="px-16 py-20 bg-[#F5F7FA]" id="event">
    <h2 class="text-3xl font-bold text-[#0A2540] mb-12" >Latest Events</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        @forelse($events as $event)
            <div class="login-card !max-w-none !p-10 shadow-xl hover:scale-[1.02] transition-transform duration-300" style="background-color: #0A2540 !important;">
                
                <h3 class="text-white text-2xl font-bold mb-2">{{ $event->title }}</h3>
                
                <p class="text-gray-400 text-sm mb-8">
                    Date: {{ \Carbon\Carbon::parse($event->date)->format('Y-m-d') }}
                </p>
                
                @php
                    $status = strtolower($event->status); 
                @endphp

                @if($status === 'upcoming')
                    <span class="event-badge badge-upcoming">Upcoming</span>
                @elseif($status === 'ongoing' || $status === 'on going')
                    <span class="event-badge badge-ongoing">Ongoing</span>
                @else
                    <span class="event-badge badge-completed">Completed</span>
                @endif

            </div>
        @empty
            <div class="col-span-3 text-center py-20">
                <p class="text-gray-500 italic ">No events found at the moment. Check back later!</p>
            </div>
        @endforelse
    </div>
</section>

    <footer class="bg-[#0A2540] py-20 flex flex-col items-center border-t border-white/10">
        <a href="/"><img src="{{ asset('image/TechHub_White_LogoMark.png') }}" class="logo-white h-20 w-auto mb-10" alt="Footer Logo"></a>
        <div class="text-center text-gray-400 text-sm space-y-3">
            <p class="font-medium">© 2026 TechHub | Designed for Academic Project</p>
            <div class="flex justify-center space-x-6">
                <a href="#" class="hover:text-[#00C896] transition-colors">Terms of Service</a>
                <a href="#" class="hover:text-[#00C896] transition-colors">Privacy Policy</a>
            </div>
        </div>
    </footer>

</body>
</html>