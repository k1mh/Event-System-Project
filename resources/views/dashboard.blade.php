<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Circle Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8F9FA; }
        .sidebar-active { background: rgba(255, 255, 255, 0.15); border-radius: 16px; }
        .card-radius { border-radius: 40px; }
    </style>
</head>
<body class="antialiased overflow-hidden">

<div class="flex h-screen w-full">
    
    <div class="w-72 bg-[#002D5B] text-white flex flex-col flex-shrink-0 shadow-2xl">
        <div class="p-10 text-center">
            <div class="inline-flex items-center justify-center w-10 h-10 border-4 border-white rounded-full mb-2">
                <div class="w-1.5 h-1.5 bg-white rounded-full"></div>
            </div>
            <h1 class="text-2xl font-extrabold tracking-tighter block">Circle</h1>
        </div>

        <nav class="flex-1 px-6 space-y-2 mt-4">
            <a href="#" class="flex items-center space-x-4 p-4 sidebar-active">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="text-[10px] font-black uppercase tracking-widest">Dashboard</span>
            </a>
            <a href="#" class="flex items-center space-x-4 p-4 text-gray-400 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <span class="text-[10px] font-black uppercase tracking-widest">Total Events</span>
            </a>
            <a href="#" class="flex items-center space-x-4 p-4 text-gray-400 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span class="text-[10px] font-black uppercase tracking-widest">Upcoming Events</span>
            </a>
            <a href="#" class="flex items-center space-x-4 p-4 text-gray-400 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                <span class="text-[10px] font-black uppercase tracking-widest">Complete Events</span>
            </a>
        </nav>

        <div class="p-8 border-t border-white/10 text-center">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-gray-400 font-bold text-[10px] uppercase tracking-widest hover:text-white">Logout</button>
            </form>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto p-12">
        
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-5xl font-black text-gray-900 tracking-tight">Dashboard</h2>
            <div class="text-right">
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest">Welcome,</p>
                <p class="text-xl font-bold text-gray-800">{{ Auth::user()->name }}</p>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-8 mb-10 text-center">
            <div class="bg-white p-10 card-radius shadow-sm border border-gray-100 flex flex-col justify-between h-48">
                <p class="text-gray-400 font-bold text-xs uppercase tracking-widest">Totals Events</p>
                <p class="text-7xl font-black text-gray-900 leading-none">{{ $totalCount }}</p>
            </div>
            <div class="bg-white p-10 card-radius shadow-sm border border-gray-100 flex flex-col justify-between h-48">
                <p class="text-gray-400 font-bold text-xs uppercase tracking-widest">Upcoming Events</p>
                <p class="text-7xl font-black text-[#00FF00] leading-none">{{ $upcomingCount }}</p>
            </div>
            <div class="bg-white p-10 card-radius shadow-sm border border-gray-100 flex flex-col justify-between h-48">
                <p class="text-gray-400 font-bold text-xs uppercase tracking-widest">Complete Events</p>
                <p class="text-7xl font-black text-[#FF0000] leading-none">{{ $completedCount }}</p>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-8 mb-10">
            <div class="col-span-2 bg-white p-10 card-radius shadow-sm border border-gray-100">
                <canvas id="lineChart" height="150"></canvas>
            </div>

            <div class="bg-white p-10 card-radius shadow-sm border border-gray-100 flex flex-col items-center justify-center">
                <div class="w-full h-44 mb-6">
                    <canvas id="doughnutChart"></canvas>
                </div>
                <div class="w-full space-y-4 px-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-6 h-1.5 bg-[#00FF00]"></div>
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Upcoming Events</span>
                        </div>
                        <span class="text-[10px] font-black text-gray-800">{{ $upcomingCount }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-6 h-1.5 bg-[#FFFF00]"></div>
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Ongoing Events</span>
                        </div>
                        <span class="text-[10px] font-black text-gray-800">5</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-6 h-1.5 bg-[#FF0000]"></div>
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Completed Events</span>
                        </div>
                        <span class="text-[10px] font-black text-gray-800">{{ $completedCount }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-10 card-radius shadow-sm border border-gray-100">
            <h3 class="text-blue-600 font-black text-xl uppercase tracking-widest mb-8">Recent Events</h3>
            <table class="w-full text-center">
                <thead>
                    <tr class="text-blue-400 text-[10px] font-black uppercase tracking-widest border-b-2 border-gray-50">
                        <th class="pb-6">Title</th>
                        <th class="pb-6">Date</th>
                        <th class="pb-6">Status</th>
                        <th class="pb-6">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($events as $event)
                    <tr>
                        <td class="py-6 font-bold text-gray-800">{{ $event->title }}</td>
                        <td class="py-6 text-gray-400 font-semibold">{{ $event->date->format('Y-m-d') }}</td>
                        <td class="py-6 font-black text-[#00FF00]">{{ strtoupper($event->status) }}</td>
                        <td class="py-6 text-blue-500 font-black hover:underline cursor-pointer">Edits</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Line Chart Initialization
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            datasets: [{
                data: [15, 8, 35, 25, 45, 32, 22, 35, 25, 45, 40, 50],
                borderColor: '#4A3AFF',
                borderWidth: 4,
                tension: 0.4,
                pointRadius: 2,
                pointBackgroundColor: '#4A3AFF'
            }]
        },
        options: { plugins: { legend: { display: false } }, scales: { y: { display: true, grid: { display: false } }, x: { grid: { display: false } } } }
    });

    // Doughnut Chart Initialization
    new Chart(document.getElementById('doughnutChart'), {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [{{ $upcomingCount }}, 5, {{ $completedCount }}],
                backgroundColor: ['#00FF00', '#FFFF00', '#FF0000'],
                borderWidth: 0
            }]
        },
        options: { cutout: '82%', plugins: { legend: { display: false } } }
    });
</script>

</body>
</html>