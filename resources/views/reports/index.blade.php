<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">
            Reports & Analytics
        </h2>
    </x-slot>
    <form
    id="filterForm"
    method="POST"
    action="{{ route('reports.export.pdf') }}"
    class="bg-white rounded-xl shadow p-5 mb-8">

        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <input type="hidden" name="status_chart" id="status_chart">

            <input type="hidden" name="source_chart" id="source_chart">

            <input type="hidden" name="monthly_chart" id="monthly_chart">

            <input type="hidden" name="revenue_chart" id="revenue_chart">
            <select
                name="status"
                class="rounded-lg border-gray-300">

                <option value="">
                    All Status
                </option>

                @foreach([
                    'New',
                    'Contacted',
                    'Qualified',
                    'Proposal',
                    'Negotiation',
                    'Won',
                    'Lost'
                ] as $status)

                    <option
                        value="{{ $status }}"
                        @selected(request('status')==$status)>

                        {{ $status }}

                    </option>

                @endforeach

            </select>

            <select
                name="source"
                class="rounded-lg border-gray-300">

                <option value="">
                    All Sources
                </option>

                @foreach([
                    'Facebook',
                    'Website',
                    'Referral',
                    'Google',
                    'Manual'
                ] as $source)

                    <option
                        value="{{ $source }}"
                        @selected(request('source')==$source)>

                        {{ $source }}

                    </option>

                @endforeach

            </select>

            <select
                name="user"
                class="rounded-lg border-gray-300">

                <option value="">
                    All Users
                </option>

                @foreach($users as $user)

                    <option
                        value="{{ $user->id }}"
                        @selected(request('user')==$user->id)>

                        {{ $user->name }}

                    </option>

                @endforeach

            </select>

            <input
                type="date"
                name="from"
                value="{{ request('from') }}"
                class="rounded-lg border-gray-300">

            <input
                type="date"
                name="to"
                value="{{ request('to') }}"
                class="rounded-lg border-gray-300">

        </div>

        <div class="mt-5 flex gap-3">

            <button
                id="filterBtn"
                type="button"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg">

                Filter

            </button>

            <a
                href="{{ route('reports.index') }}"
                class="bg-gray-500 text-white px-6 py-2 rounded-lg">

                Reset

            </a>

        </div>

    </form>

    <div class="w-full max-w-9/10 mx-auto">

        <!-- Header -->

        <div class="flex justify-between items-center mb-8">

            <div>

                <h1 class="text-3xl font-bold text-gray-800">
                    Reports Dashboard
                </h1>

                <p class="text-gray-500 mt-2">
                    Overview of your CRM performance
                </p>

            </div>

            <div class="flex gap-3">

                {{-- <button
                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg">

                    Export Excel

                </button> --}}

                <a
                    id="excelExportBtn"
                    href="{{ route('reports.export.excel') }}"
                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg">

                    Export Excel

                </a>

                <a
                    id="pdfExportBtn"
                    href="{{ route('reports.export.pdf') }}"
                    class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg">

                    Export PDF

                </a>

            </div>

        </div>

        <!-- KPI Cards -->

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-6 gap-6">

            <!-- Total Leads -->
            <div class="bg-white rounded-xl shadow hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border-l-4 border-blue-500 p-5">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Total Leads</p>

                        <h2 id="totalLeads"
                            class="text-4xl font-bold mt-2 text-gray-900">
                            {{ $totalLeads }}
                        </h2>
                    </div>

                    <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center">
                        <i class="fa-solid fa-users text-2xl text-blue-600"></i>
                    </div>
                </div>
            </div>

            <!-- Won -->
            <div class="bg-white rounded-xl shadow hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border-l-4 border-green-500 p-5">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Won Deals</p>

                        <h2 id="wonLeads"
                            class="text-4xl font-bold mt-2 text-green-600">
                            {{ $wonLeads }}
                        </h2>
                    </div>

                    <div class="w-14 h-14 rounded-full bg-green-100 flex items-center justify-center">
                        <i class="fa-solid fa-circle-check text-2xl text-green-600"></i>
                    </div>
                </div>
            </div>

            <!-- Lost -->
            <div class="bg-white rounded-xl shadow hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border-l-4 border-red-500 p-5">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Lost Deals</p>

                        <h2 id="lostLeads"
                            class="text-4xl font-bold mt-2 text-red-600">
                            {{ $lostLeads }}
                        </h2>
                    </div>

                    <div class="w-14 h-14 rounded-full bg-red-100 flex items-center justify-center">
                        <i class="fa-solid fa-circle-xmark text-2xl text-red-600"></i>
                    </div>
                </div>
            </div>

            <!-- Pending Task -->
            <div class="bg-white rounded-xl shadow hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border-l-4 border-yellow-500 p-5">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Pending Tasks</p>

                        <h2 id="pendingTasks"
                            class="text-4xl font-bold mt-2 text-yellow-500">
                            {{ $pendingTasks }}
                        </h2>
                    </div>

                    <div class="w-14 h-14 rounded-full bg-yellow-100 flex items-center justify-center">
                        <i class="fa-solid fa-list-check text-2xl text-yellow-600"></i>
                    </div>
                </div>
            </div>

            <!-- Pending Followup -->
            <div class="bg-white rounded-xl shadow hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border-l-4 border-sky-500 p-5">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Pending Follow-up</p>

                        <h2 id="pendingFollowUps"
                            class="text-4xl font-bold mt-2 text-blue-600">
                            {{ $pendingFollowUps }}
                        </h2>
                    </div>

                    <div class="w-14 h-14 rounded-full bg-sky-100 flex items-center justify-center">
                        <i class="fa-solid fa-phone-volume text-2xl text-sky-600"></i>
                    </div>
                </div>
            </div>

            <!-- Conversion -->
            <div class="bg-white rounded-xl shadow hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border-l-4 border-indigo-500 p-5">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Conversion Rate</p>

                        <h2 id="conversionRate"
                            class="text-4xl font-bold mt-2 text-indigo-600">
                            {{ $conversionRate }}%
                        </h2>
                    </div>

                    <div class="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center">
                        <i class="fa-solid fa-chart-line text-2xl text-indigo-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border-l-4 border-green-500 p-5">

                <p class="text-gray-500 text-sm">
                    Total Revenue
                </p>

                <h2 id="totalRevenue"
                    class="text-4xl font-bold text-green-600 mt-3">

                    ₹ {{ number_format($totalRevenue) }}

                </h2>

            </div>
            <div class="bg-white rounded-xl shadow hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border-l-4 border-blue-500 p-5">

                <p class="text-gray-500 text-sm">
                    Expected Revenue
                </p>

                <h2 id="expectedRevenue"
                    class="text-4xl font-bold text-blue-600 mt-3">

                    ₹ {{ number_format($expectedRevenue) }}

                </h2>

            </div>
            <div class="bg-white rounded-xl shadow hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border-l-4 border-purple-500 p-5">

                <p class="text-gray-500 text-sm">
                    Average Deal
                </p>

                <h2 id="averageDealValue"
                    class="text-4xl font-bold text-purple-600 mt-3">

                    ₹ {{ number_format($averageDealValue) }}

                </h2>

            </div>
            <div class="bg-white rounded-xl shadow hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border-l-4 border-orange-500 p-5">

                <p class="text-gray-500 text-sm">
                    Largest Deal
                </p>

                <h2 id="largestDeal"
                    class="text-4xl font-bold text-orange-600 mt-3">

                    ₹ {{ number_format($largestDeal) }}

                </h2>

            </div>

        </div>



        <!-- Charts -->

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

            <div class="bg-white rounded-xl shadow p-6">

                <h3 class="text-xl font-bold mb-5">

                    Sales Funnel

                </h3>

                <div class="h-72">

                    <canvas id="statusChart"></canvas>

                </div>

            </div>

            <div class="bg-white rounded-xl shadow p-6">

                <h3 class="text-xl font-bold mb-5">

                    Lead Sources

                </h3>

                <div class="h-72">

                    <canvas id="sourceChart"></canvas>

                </div>

            </div>

        </div>

        <!-- Monthly Chart -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

            <div class="bg-white rounded-xl shadow p-6 mt-8">

                <h3 class="text-xl font-bold mb-5">

                    Monthly Leads

                </h3>

                <div class="h-72">

                    <canvas id="monthlyChart"></canvas>

                </div>

            </div>
            <div class="bg-white rounded-xl shadow p-6 mt-8">

                <h3 class="text-xl font-bold mb-5">
                    Monthly Revenue
                </h3>

                <div class="h-72">

                    <canvas id="monthlyRevenueChart"></canvas>

                </div>

            </div>
        </div>

        <!-- Recent Won Deals -->

        <div class="bg-white rounded-xl shadow mt-8">

            <div class="p-6 border-b">

                <h3 class="text-xl font-bold">

                    Recent Won Deals

                </h3>

            </div>

            <table class="min-w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="text-left px-6 py-3">
                            Customer
                        </th>

                        <th class="text-left px-6 py-3">
                            Email
                        </th>

                        <th class="text-left px-6 py-3">
                            Value
                        </th>

                    </tr>

                </thead>

                <tbody id="wonDealsTable">

                    @foreach($recentWonDeals as $lead)

                        <tr class="border-b">

                            <td class="px-6 py-4">
                                {{ $lead->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $lead->email }}
                            </td>

                            <td class="px-6 py-4">

                                ₹ {{ number_format($lead->value ?? 0) }}

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/countup.js@2.8.0/dist/countUp.umd.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    function animateCounter(id, value, suffix = '', prefix = '') {

        const counterInstance = new countUp.CountUp(id, value, {

            duration: 1.2,
            separator: ',',
            suffix: suffix,
            prefix: prefix

        });

        if (counterInstance.error) {

            console.error(counterInstance.error);

        } else {

            counterInstance.start();

        }

    }
//
// ==========================
// Sales Funnel Chart
// ==========================
//

const statusCtx = document.getElementById('statusChart');

const statusChart = new Chart(statusCtx,{

    type:'doughnut',

    data:{

        labels:[
            'New',
            'Contacted',
            'Qualified',
            'Proposal',
            'Negotiation',
            'Won',
            'Lost'
        ],

        datasets:[{

            data:[
                {{ $statusChart['New'] }},
                {{ $statusChart['Contacted'] }},
                {{ $statusChart['Qualified'] }},
                {{ $statusChart['Proposal'] }},
                {{ $statusChart['Negotiation'] }},
                {{ $statusChart['Won'] }},
                {{ $statusChart['Lost'] }}
            ],

            backgroundColor:[
                '#3B82F6',
                '#6366F1',
                '#F59E0B',
                '#A855F7',
                '#FB923C',
                '#22C55E',
                '#EF4444'
            ],

            borderWidth:2,
            borderColor:'#fff'

        }]

    },

    options:{

        responsive:true,

        maintainAspectRatio:false,

        cutout:'65%',

        plugins:{

            legend:{
                position:'right'
            }

        }

    }

});


//
// ==========================
// Lead Source Chart
// ==========================
//

const sourceCtx=document.getElementById('sourceChart');

const sourceChart = new Chart(sourceCtx,{

    type:'pie',

    data:{

        labels:@json($sourceChart->keys()),

        datasets:[{

            data:@json($sourceChart->values()),

            backgroundColor:[

                '#3B82F6',
                '#22C55E',
                '#F59E0B',
                '#EF4444',
                '#A855F7',
                '#14B8A6',
                '#FB7185',
                '#6366F1'

            ]

        }]

    },

    options:{

        responsive:true,

        maintainAspectRatio:false,

        plugins:{

            legend:{
                position:'right'
            }

        }

    }

});


//
// ==========================
// Monthly Leads
// ==========================
//

const monthlyCanvas=document.getElementById('monthlyChart');

const monthlyCtx=monthlyCanvas.getContext('2d');

const gradient=monthlyCtx.createLinearGradient(0,0,0,400);

gradient.addColorStop(0,'#2563eb');

gradient.addColorStop(1,'#60a5fa');

const monthlyChart = new Chart(monthlyCtx,{

    type:'bar',

    data:{

        labels:[
            'Jan','Feb','Mar','Apr','May','Jun',
            'Jul','Aug','Sep','Oct','Nov','Dec'
        ],

        datasets:[{

            label:'Leads',

            data:@json($monthlyLeads),

            backgroundColor:gradient,

            borderRadius:8,

            hoverBackgroundColor:'#1d4ed8'

        }]

    },

    options:{

        responsive:true,

        maintainAspectRatio:false,

        plugins:{

            legend:{
                display:false
            },

            tooltip:{

                callbacks:{

                    label:function(context){

                        return "Leads : "+context.parsed.y;

                    }

                }

            }

        },

        scales:{

            y:{

                beginAtZero:true,

                ticks:{
                    precision:0
                }

            },

            x:{

                grid:{
                    display:false
                }

            }

        }

    }

});

const revenueCtx = document.getElementById('monthlyRevenueChart');

const revenueChart = new Chart(revenueCtx,{

    type:'line',

    data:{

        labels:[
            'Jan','Feb','Mar','Apr','May','Jun',
            'Jul','Aug','Sep','Oct','Nov','Dec'
        ],

        datasets:[{

            label:'Revenue',

            data:@json($monthlyRevenue),

            borderColor:'#16a34a',

            backgroundColor:'rgba(22,163,74,.15)',

            fill:true,

            tension:.4

        }]

    },

    options:{

        responsive:true,

        maintainAspectRatio:false

    }

});

// ==========================
// AJAX Filter
// ==========================
document.getElementById('filterBtn').addEventListener('click', function () {

    const form = document.getElementById('filterForm');

    const btn = this;

    btn.disabled = true;
    btn.innerHTML = 'Filtering...';

    const params = new URLSearchParams(new FormData(form));

    fetch("{{ route('reports.filter') }}?" + params.toString(), {
        headers: {
            'Accept': 'application/json'
        }
    })

    .then(response => {

        if (!response.ok) {
            throw new Error('Request failed');
        }

        return response.json();

    })

    .then(data => {

        // KPI
        animateCounter('totalLeads', data.totalLeads);
        animateCounter('wonLeads', data.wonLeads);
        animateCounter('lostLeads', data.lostLeads);
        animateCounter('pendingTasks', data.pendingTasks);
        animateCounter('pendingFollowUps', data.pendingFollowUps);
        animateCounter('conversionRate', data.conversionRate, '%');

        animateCounter('totalRevenue', data.totalRevenue, '', '₹ ');
        animateCounter('expectedRevenue', data.expectedRevenue, '', '₹ ');
        animateCounter('averageDealValue', data.averageDealValue, '', '₹ ');
        animateCounter('largestDeal', data.largestDeal, '', '₹ ');

        // Sales Funnel
        statusChart.data.datasets[0].data = [
            data.statusChart.New,
            data.statusChart.Contacted,
            data.statusChart.Qualified,
            data.statusChart.Proposal,
            data.statusChart.Negotiation,
            data.statusChart.Won,
            data.statusChart.Lost
        ];
        statusChart.update();

        // Source
        sourceChart.data.labels = data.sourceChart.labels;
        sourceChart.data.datasets[0].data = data.sourceChart.values;
        sourceChart.update();

        // Monthly Leads
        monthlyChart.data.datasets[0].data = data.monthlyLeads;
        monthlyChart.update();

        // Revenue
        revenueChart.data.datasets[0].data = data.monthlyRevenue;
        revenueChart.update();

        // Recent Won Deals
        let html = '';

        if (data.recentWonDeals.length === 0) {

            html = `
                <tr>
                    <td colspan="3" class="text-center py-8 text-gray-500">
                        No Won Deals
                    </td>
                </tr>
            `;

        } else {

            data.recentWonDeals.forEach(item => {

                html += `
                    <tr class="border-b">
                        <td class="px-6 py-4">${item.name}</td>
                        <td class="px-6 py-4">${item.email}</td>
                        <td class="px-6 py-4">
                            ₹ ${Number(item.value ?? 0).toLocaleString()}
                        </td>
                    </tr>
                `;

            });

        }

        document.getElementById('wonDealsTable').innerHTML = html;

    })

    .catch(error => {

        console.error(error);

        alert('Something went wrong.');

    })

    .finally(() => {

        btn.disabled = false;
        btn.innerHTML = 'Filter';

    });

});
// ======================================
// Animated Counter
// ======================================

document.addEventListener("DOMContentLoaded", function () {

    const counters = [

        {
            id: 'totalLeads',
            value: {{ $totalLeads }}
        },

        {
            id: 'wonLeads',
            value: {{ $wonLeads }}
        },

        {
            id: 'lostLeads',
            value: {{ $lostLeads }}
        },

        {
            id: 'pendingTasks',
            value: {{ $pendingTasks }}
        },

        {
            id: 'pendingFollowUps',
            value: {{ $pendingFollowUps }}
        },

        {
            id: 'conversionRate',
            value: {{ $conversionRate }},
            suffix: '%'
        },

        {
            id: 'totalRevenue',
            value: {{ $totalRevenue }}
        },

        {
            id: 'expectedRevenue',
            value: {{ $expectedRevenue }},
            prefix:'₹ '
        },

        {
            id: 'averageDealValue',
            value: {{ $averageDealValue }},
            prefix:'₹ '
        },

        {
            id: 'largestDeal',
            value: {{ $largestDeal }},
            prefix:'₹ '
        }

    ];

    counters.forEach(counter => {

        const options = {

            duration: 2,

            separator: ',',

            decimal: '.',

            suffix:counter.suffix ?? '',

            prefix:counter.prefix ?? ''

        };


        const counterInstance = new countUp.CountUp(
            counter.id,
            counter.value,
            options
        );

        if (counterInstance.error) {

            console.error(counterInstance.error);

        } else {

            counterInstance.start();

        }

        // if (!countUp.error) {

        //     countUp.start();

        // }

    });

});

document.getElementById('excelExportBtn').addEventListener('click', function () {

    const params = new URLSearchParams(
        new FormData(document.getElementById('filterForm'))
    );

    this.href = "{{ route('reports.export.excel') }}?" + params.toString();

});

// document.getElementById('pdfExportBtn').addEventListener('click', function(){

//     const params = new URLSearchParams(
//         new FormData(
//             document.getElementById('filterForm')
//         )
//     );

//     this.href =
//         "{{ route('reports.export.pdf') }}?"
//         + params.toString();

// });
// document
// .getElementById('pdfExportBtn')
// .addEventListener('click',function(e){

//     e.preventDefault();

//     document.getElementById('status_chart').value =
//         statusChart.toBase64Image();

//     document.getElementById('source_chart').value =
//         sourceChart.toBase64Image();

//     document.getElementById('monthly_chart').value =
//         monthlyChart.toBase64Image();

//     document.getElementById('revenue_chart').value =
//         revenueChart.toBase64Image();

//     const params=new URLSearchParams(
//         new FormData(document.getElementById('filterForm'))
//     );

//     window.location =
//         this.href+'?'+params.toString();

// });
document.getElementById('pdfExportBtn').onclick=function(e){

    e.preventDefault();

    document.getElementById('status_chart').value =
        statusChart.toBase64Image();

    document.getElementById('source_chart').value =
        sourceChart.toBase64Image();

    document.getElementById('monthly_chart').value =
        monthlyChart.toBase64Image();

    document.getElementById('revenue_chart').value =
        revenueChart.toBase64Image();

    document.getElementById('filterForm').submit();

};
</script>

</x-app-layout>
