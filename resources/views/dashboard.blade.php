<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Messages Handler -->
    <div class="py-16">
        <div class="max-w-5xl mx-auto px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-8 text-gray-900">
                    <h3 class="text-3xl font-bold text-gray-800 mb-6 flex items-center">
                        Messages
                        @if ($unreadCount = \App\Models\ContactForm::where('is_read', false)->count())
                        <span class="ml-3 px-3 py-1 text-sm font-semibold text-white bg-red-600 rounded-full">
                            {{ $unreadCount }}
                        </span>
                        @endif
                    </h3>
                    <ul class="divide-y divide-gray-200">
                        @forelse ($messages = \App\Models\ContactForm::orderBy('created_at', 'desc')->take(5)->get() as $message)
                        <li class="py-5 flex items-center justify-between space-x-6">
                            <!-- Left Section -->
                            <div class="flex-1">
                                <p class="text-sm text-gray-600"><strong>Email:</strong> {{ $message->email }}</p>
                                <p class="mt-1 text-lg font-medium text-gray-800">{{ $message->subject }}</p>
                            </div>
                            <!-- Status Badge -->
                            <div class="flex-shrink-0">
                                <span class="px-4 py-1 text-sm font-semibold rounded-full 
                {{ $message->is_read ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                    {{ $message->is_read ? 'Read' : 'Unread' }}
                                </span>
                            </div>
                            <!-- Action Buttons -->
                            <div class="flex-shrink-0 flex space-x-4">
                                <button class="text-blue-600 hover:text-blue-800 font-semibold"
                                    onclick="document.getElementById('message-{{ $message->id }}').classList.remove('hidden')">
                                    View
                                </button>
                                <form action="{{ route('messages.destroy', $message->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </li>
                        @empty
                        <li class="py-5 text-center text-gray-500">
                            No messages yet.
                        </li>
                        @endforelse
                    </ul>

                </div>
            </div>
        </div>
    </div>

    @foreach ($messages as $message)
    <div class="hidden fixed z-10 inset-0 overflow-y-auto" id="message-{{ $message->id }}" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen bg-gray-900 bg-opacity-50">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-lg p-6 relative">
                <button type="button" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700"
                    onclick="document.getElementById('message-{{ $message->id }}').classList.add('hidden')">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <h3 class="text-xl font-bold text-gray-800">{{ $message->subject }}</h3>
                <p class="mt-4 text-gray-600">{{ $message->message }}</p>
                <div class="mt-6 flex justify-end space-x-3">
                    <form action="{{ route('messages.destroy', $message->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700">
                            Delete
                        </button>
                    </form>
                    <button type="button" class="px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300"
                        onclick="document.getElementById('message-{{ $message->id }}').classList.add('hidden')">
                        Cancel
                    </button>
                    <button type="button" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700"
                        onclick="updateMessageAsRead('{{ $message->id }}'); location.reload();">
                        Mark as Read
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <script>
        function updateMessageAsRead(messageId) {
            fetch(`/messages/${messageId}/read`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        is_read: true
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>

    <!-- Job Statistics Chart -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-4 text-center text-gray-800">
                        Job Statistics (Last Year)
                    </h3>
                    <canvas id="jobChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const jobStats = JSON.parse(`<?php echo json_encode($jobStats); ?>`);

        const monthNames = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        // Extract month names and job counts from jobStats
        const months = jobStats.map(item => monthNames[item.month - 1]);
        const jobCounts = jobStats.map(item => item.job_count);

        const ctx = document.getElementById('jobChart').getContext('2d');

        const jobChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Jobs Published',
                    data: jobCounts,
                    fill: false,
                    backgroundColor: '#FFB74D',
                    borderColor: '#FFB74D',
                    pointBackgroundColor: '#FFB74D',
                    pointBorderColor: '#FFB74D',
                    pointBorderWidth: 5,
                    pointRadius: 5,
                    pointHoverRadius: 10,
                    pointHitRadius: 30,
                    lineTension: 0.2,
                }],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#333',
                            font: {
                                size: 14,
                            },
                        },
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return `Jobs: ${tooltipItem.raw}`;
                            },
                        },
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Month',
                            color: '#333',
                            font: {
                                size: 14,
                                weight: 'bold',
                            },
                        },
                        ticks: {
                            color: '#555',
                            font: {
                                size: 12,
                            },
                        },
                        grid: {
                            display: false,
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Number of Jobs',
                            color: '#333',
                            font: {
                                size: 14,
                                weight: 'bold',
                            },
                        },
                        ticks: {
                            color: '#555',
                            font: {
                                size: 12,
                            },
                            beginAtZero: true,
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)',
                        },
                    },
                },
            },
        });
    </script>


</x-app-layout>