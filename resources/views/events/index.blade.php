<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<x-app-layout>
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-gray-900">Dashboard</h2>
        <p class="text-gray-500">Real-time analytics and event tracking.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-10">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <p class="text-gray-500 font-semibold text-sm uppercase tracking-wider mb-2">Total Events</p>
            <h3 class="text-3xl font-bold text-gray-900">{{ $events->count() }}</h3>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <p class="text-gray-500 font-semibold text-sm uppercase tracking-wider mb-2">Upcoming</p>
            <h3 class="text-3xl font-bold text-yellow-500">{{ $events->where('status', 'upcoming')->count() }}</h3>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <p class="text-gray-500 font-semibold text-sm uppercase tracking-wider mb-2">Ongoing</p>
            <h3 class="text-3xl font-bold text-green-500">{{ $events->where('status', 'ongoing')->count() }}</h3>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <p class="text-gray-500 font-semibold text-sm uppercase tracking-wider mb-2">Completed</p>
            <h3 class="text-3xl font-bold text-red-500">{{ $events->where('status', 'completed')->count() }}</h3>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                <i class="fa-solid fa-chart-line mr-2 text-blue-500"></i> Event Distribution Charts
            </h3>
            <div class="relative h-[300px] w-full">
                <canvas id="lineChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                <i class="fa-solid fa-chart-pie mr-2 text-purple-500"></i> Event Status Distribution
            </h3>
            <div class="relative h-[300px] w-full">
                <canvas id="doughnutChart"></canvas>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-sm border border-gray-100 rounded-2xl overflow-hidden">
        <div class="p-6 border-b border-gray-50">
            <h3 class="text-blue-600 font-bold text-xl uppercase tracking-widest">Recent Events</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/50 text-gray-500 text-xs uppercase font-bold">
                        <th class="px-6 py-4">Title</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-50">
                    @forelse($events as $event)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-5 font-medium text-gray-900">{{ $event->title }}</td>
                        <td class="px-6 py-5 text-gray-500">
                            <i class="fa-regular fa-clock mr-1"></i> 
                                {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }} 
                                at 
                                {{ \Carbon\Carbon::parse($event->time)->format('H:i') }}
                        </td>
                        <td class="px-6 py-5">
                            @php
                                $statusColor = match(strtolower($event->status)) {
                                    'upcoming' => 'text-yellow-500 bg-yellow-50',
                                    'ongoing' => 'text-green-600 bg-green-50',
                                    'completed' => 'text-red-500 bg-red-50',
                                    default => 'text-gray-500 bg-gray-50'
                                };
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $statusColor }}">
                                {{ $event->status }}
                            </span>
                        </td>
                        <td class="px-6 py-5 text-right">
                            <a href="{{ route('events.edit', $event) }}" class="text-blue-500 hover:text-blue-700 font-bold">Edit</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-10 text-center text-gray-400 italic">No events found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const upcoming = {{ $events->where('status', 'upcoming')->count() }};
            const ongoing = {{ $events->where('status', 'ongoing')->count() }};
            const completed = {{ $events->where('status', 'completed')->count() }};

            // 1. Line Chart
            const ctxLine = document.getElementById('lineChart').getContext('2d');
            new Chart(ctxLine, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Attendees',
                        data: [65, 59, 80, 81, 56, 95],
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } }
                }
            });

            // 2. Doughnut Chart
            const ctxDoughnut = document.getElementById('doughnutChart').getContext('2d');
            new Chart(ctxDoughnut, {
                type: 'doughnut',
                data: {
                    labels: ['Upcoming', 'Ongoing', 'Completed'],
                    datasets: [{
                        data: [upcoming, ongoing, completed],
                        backgroundColor: ['#eab308', '#08ea40', '#ef4444'],
                        hoverOffset: 10,
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 30,
                                font: { size: 12, weight: '600' }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>