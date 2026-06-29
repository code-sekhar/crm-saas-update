{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            CRM Dashboard
        </h2>
    </x-slot>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
<div class="py-2">
    <div class=" mx-auto sm:px-4 lg:px-4">

        <div class="mb-8">

            <div class="flex justify-between items-center">

                <div>

                    <h1 class="text-3xl font-bold text-gray-800">

                        Welcome Back,
                        {{ auth()->user()->name }}

                        👋

                    </h1>

                    <p class="text-gray-500 mt-2">

                        {{ now()->format('l, d F Y') }}

                    </p>

                </div>

                <div>

                    <a
                        href="{{ route('leads.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg shadow">

                        + New Lead

                    </a>

                </div>

            </div>

        </div>



        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-6 mb-8">
            {{-- Total Leads --}}

            <div class="bg-white rounded-xl shadow p-6">

                <div class="text-gray-500">

                    Total Leads

                </div>

                <div class="text-4xl font-bold mt-3">

                    {{ $totalLeads }}

                </div>

            </div>

            {{-- Today's Leads --}}

            <div class="bg-white rounded-xl shadow p-6">

                <div class="text-gray-500">

                    Today's Leads

                </div>

                <div class="text-4xl font-bold mt-3 text-blue-600">

                    {{ $todayLeads }}

                </div>

            </div>

            {{-- Won --}}

            <div class="bg-white rounded-xl shadow p-6">

                <div class="text-gray-500">

                    Won

                </div>

                <div class="text-4xl font-bold mt-3 text-green-600">

                    {{ $wonLeads }}

                </div>

            </div>

            {{-- Lost --}}

            <div class="bg-white rounded-xl shadow p-6">

                <div class="text-gray-500">

                    Lost

                </div>

                <div class="text-4xl font-bold mt-3 text-red-600">

                    {{ $lostLeads }}

                </div>

            </div>

            {{-- Pending Tasks --}}

            <div class="bg-white rounded-xl shadow p-6">

                <div class="text-gray-500">

                    Pending Tasks

                </div>

                <div class="text-4xl font-bold mt-3 text-yellow-500">

                    {{ $pendingTasks }}

                </div>

            </div>
            {{-- Conversion Rate --}}

            <div class="bg-white rounded-xl shadow p-6">

                <div class="text-gray-500">

                    Conversion Rate

                </div>

                <div class="text-4xl font-bold mt-3 text-indigo-600">

                    {{ $conversionRate }}%

                </div>

            </div>

        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

            <div class="rounded-xl bg-blue-600 text-white p-6 shadow">

                <div class="text-lg">

                    Today's Follow-up

                </div>

                <div class="text-5xl font-bold mt-4">

                    {{ $todayFollowUps }}

                </div>

            </div>

            <div class="rounded-xl bg-yellow-500 text-white p-6 shadow">

                <div class="text-lg">

                    Upcoming

                </div>

                <div class="text-5xl font-bold mt-4">

                    {{ $upcomingFollowUps }}

                </div>

            </div>

            <div class="rounded-xl bg-red-500 text-white p-6 shadow">

                <div class="text-lg">

                    Overdue

                </div>

                <div class="text-5xl font-bold mt-4">

                    {{ $overdueFollowUps }}

                </div>

            </div>

            <div class="rounded-xl bg-green-600 text-white p-6 shadow">

                <div class="text-lg">

                    Completed

                </div>

                <div class="text-5xl font-bold mt-4">

                    {{ $completedFollowUps }}

                </div>

            </div>

        </div>
        {{-- <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-6">

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <p class="text-sm text-gray-500">Total Leads</p>
                    <h3 class="text-3xl font-bold mt-2">
                        {{ $totalLeads ?? 0 }}
                    </h3>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <p class="text-sm text-gray-500">Today's Leads</p>
                    <h3 class="text-3xl font-bold mt-2">
                        {{ $todayLeads ?? 0 }}
                    </h3>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <p class="text-sm text-gray-500">Won Leads</p>
                    <h3 class="text-3xl font-bold mt-2 text-green-600">
                        {{ $wonLeads ?? 0 }}
                    </h3>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <p class="text-sm text-gray-500">Lost Leads</p>
                    <h3 class="text-3xl font-bold mt-2 text-red-600">
                        {{ $lostLeads ?? 0 }}
                    </h3>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <p class="text-sm text-gray-500">Pending Tasks</p>
                    <h3 class="text-3xl font-bold mt-2 text-yellow-600">
                        {{ $pendingTasks ?? 0 }}
                    </h3>
                </div>
            </div>
            <div class="bg-blue-500 text-white rounded-lg p-6">
                <h3 class="text-lg font-bold">Today's Follow-ups</h3>
                <p class="text-4xl mt-3">{{ $todayFollowUps }}</p>
            </div>

            <div class="bg-yellow-500 text-white rounded-lg p-6">
                <h3 class="text-lg font-bold">Upcoming</h3>
                <p class="text-4xl mt-3">{{ $upcomingFollowUps }}</p>
            </div>

            <div class="bg-red-500 text-white rounded-lg p-6">
                <h3 class="text-lg font-bold">Overdue</h3>
                <p class="text-4xl mt-3">{{ $overdueFollowUps }}</p>
            </div>

            <div class="bg-green-600 text-white rounded-lg p-6">
                <h3 class="text-lg font-bold">Completed</h3>
                <p class="text-4xl mt-3">{{ $completedFollowUps }}</p>
            </div>

        </div> --}}

        <!-- Recent Leads -->
        <!-- Sales Pipeline -->

        <div class="bg-white shadow rounded-xl p-6 mb-8">

            <div class="flex justify-between items-center mb-6">

                <h2 class="text-xl font-bold">

                    Sales Pipeline

                </h2>

                <a href="{{ route('leads.index') }}"
                class="text-blue-600 font-semibold">

                    View All →

                </a>

            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-5">

                <div class="bg-blue-50 rounded-lg p-5 text-center">

                    <div class="text-gray-500">
                        New
                    </div>

                    <div class="text-3xl font-bold mt-3 text-blue-600">
                        {{ $newLeads }}
                    </div>

                </div>

                <div class="bg-indigo-50 rounded-lg p-5 text-center">

                    <div class="text-gray-500">
                        Contacted
                    </div>

                    <div class="text-3xl font-bold mt-3 text-indigo-600">
                        {{ $contactedLeads }}
                    </div>

                </div>

                <div class="bg-yellow-50 rounded-lg p-5 text-center">

                    <div class="text-gray-500">
                        Qualified
                    </div>

                    <div class="text-3xl font-bold mt-3 text-yellow-600">
                        {{ $qualifiedLeads }}
                    </div>

                </div>

                <div class="bg-purple-50 rounded-lg p-5 text-center">

                    <div class="text-gray-500">
                        Proposal
                    </div>

                    <div class="text-3xl font-bold mt-3 text-purple-600">
                        {{ $proposalLeads }}
                    </div>

                </div>

                <div class="bg-orange-50 rounded-lg p-5 text-center">

                    <div class="text-gray-500">
                        Negotiation
                    </div>

                    <div class="text-3xl font-bold mt-3 text-orange-600">
                        {{ $negotiationLeads }}
                    </div>

                </div>

                <div class="bg-green-50 rounded-lg p-5 text-center">

                    <div class="text-gray-500">
                        Won
                    </div>

                    <div class="text-3xl font-bold mt-3 text-green-600">
                        {{ $wonLeads }}
                    </div>

                </div>

            </div>

        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6 mb-8">
            <div class="bg-white shadow rounded-xl p-6 h-[500px]">

                <h2 class="text-xl font-bold mb-5">

                    Lead Status Analytics

                </h2>

                <div class="h-96">

                    <canvas id="statusChart"></canvas>

                </div>

            </div>
            <div class="bg-white shadow rounded-xl p-6 h-[500px]">

                <h2 class="text-xl font-bold mb-5">

                    Monthly Leads

                </h2>

                <div class="h-96">

                    <canvas id="monthlyChart"></canvas>

                </div>

            </div>
        </div>

         <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-6 mb-8">
            <div class="bg-white shadow rounded-lg">
                <div class="p-6 border-b">
                    <h3 class="text-lg font-semibold">
                        Recent Leads
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Name
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Email
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Source
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Status
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">

                            @forelse($recentLeads ?? [] as $lead)

                                <tr>
                                    <td class="px-6 py-4">
                                        {{ $lead->name }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $lead->email }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $lead->source }}
                                    </td>

                                    {{-- <td class="px-6 py-4">
                                        {{ $lead->status }}
                                    </td> --}}
                                    <td class="px-6 py-4">
                                        @if($lead->status == 'New')
                                            <span class="px-2 py-1 bg-blue-500 text-white rounded text-xs">
                                                New
                                            </span>

                                        @elseif($lead->status == 'Won')
                                            <span class="px-2 py-1 bg-green-500 text-white rounded text-xs">
                                                Won
                                            </span>

                                        @elseif($lead->status == 'Lost')
                                            <span class="px-2 py-1 bg-red-500 text-white rounded text-xs">
                                                Lost
                                            </span>

                                        @else
                                            <span class="px-2 py-1 bg-gray-500 text-white rounded text-xs">
                                                {{ $lead->status }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        No leads found.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>
                </div>
            </div>
         </div>


    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('statusChart');

new Chart(ctx, {

    type: 'doughnut',

    data: {

        labels: [
            'New',
            'Contacted',
            'Qualified',
            'Proposal',
            'Won',
            'Lost'
        ],

        datasets: [{

            data: [
                {{ $statusChart['New'] }},
                {{ $statusChart['Contacted'] }},
                {{ $statusChart['Qualified'] }},
                {{ $statusChart['Proposal'] }},
                {{ $statusChart['Won'] }},
                {{ $statusChart['Lost'] }}
            ],

            backgroundColor: [
                '#3B82F6', // New
                '#6366F1', // Contacted
                '#F59E0B', // Qualified
                '#A855F7', // Proposal
                '#22C55E', // Won
                '#EF4444'  // Lost
            ],

            borderWidth: 2,
            borderColor: '#fff'

        }]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        cutout: '65%',

        plugins: {

            legend: {

                position: 'right',

                labels: {
                    padding: 20,
                    usePointStyle: true
                }

            },

            title: {

                display: false,

                text: 'Lead Status Distribution',

                font: {
                    size: 18
                }

            },
            tooltip: {

                callbacks: {

                    label: function(context) {

                        return ' Leads: ' + context.parsed.x;

                    }

                }

            }

        },

        animation: {

            animateRotate: true,

            duration: 1200

        }

    }

});
const monthlyCanvas = document.getElementById('monthlyChart');

const monthlyCtx = monthlyCanvas.getContext('2d');

const gradient = monthlyCtx.createLinearGradient(0,0,0,400);

gradient.addColorStop(0,'#2563eb');
gradient.addColorStop(1,'#60a5fa');

new Chart(monthlyCtx, {

    type: 'bar',

    data: {

        labels: [
            'Jan','Feb','Mar','Apr','May','Jun',
            'Jul','Aug','Sep','Oct','Nov','Dec'
        ],

        datasets: [{

            label: 'Leads',

            data: @json($monthlyLeads),

            backgroundColor: gradient,

            borderRadius: 8,

            borderWidth: 0,

            hoverBackgroundColor: '#1d4ed8'

        }]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        plugins: {

            legend: {
                display: false
            },

            title: {
                display: false,
                text: 'Monthly Lead Generation'
            },
            // tooltip: {
            //     callbacks: {
            //         label: function(context) {
            //             return context.dataset.label + ": " + context.parsed.y;
            //         }
            //     }
            // }
            tooltip: {
                backgroundColor: '#111827',
                titleColor: '#fff',
                bodyColor: '#fff',
                padding: 12,

                callbacks: {
                    title: function(context) {
                        return context[0].label + " 2026";
                    },
                    label: function(context) {
                        return "Total Leads : " + context.parsed.y;
                    }
                }
            }
        },

        scales: {

            y: {
                beginAtZero: true,
                ticks: {
                    precision: 0
                }
            },

            x: {
                grid: {
                    display: false
                }
            }

        }

    }

});
</script>
</x-app-layout>
