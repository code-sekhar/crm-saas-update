<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">

            <h2 class="text-2xl font-bold text-gray-800">
                Audit Logs
            </h2>

            <div class="flex gap-2">

                <a href="#"
                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg">

                    Export Excel

                </a>

                <a href="#"
                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">

                    Export PDF

                </a>

            </div>

        </div>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto px-6">

            {{-- Statistics --}}

            <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">

                <div class="bg-white rounded-xl shadow p-5">

                    <div class="text-gray-500">

                        Total Logs

                    </div>

                    <div class="text-3xl font-bold mt-2">

                        {{ $logs->total() }}

                    </div>

                </div>

                <div class="bg-white rounded-xl shadow p-5">

                    <div class="text-gray-500">

                        Today's Logs

                    </div>

                    <div class="text-3xl font-bold mt-2">

                        {{ $todayLogs }}

                    </div>

                </div>

                <div class="bg-white rounded-xl shadow p-5">

                    <div class="text-gray-500">

                        Lead Logs

                    </div>

                    <div class="text-3xl font-bold mt-2">

                        {{ $leadLogs }}

                    </div>

                </div>

                <div class="bg-white rounded-xl shadow p-5">

                    <div class="text-gray-500">

                        User Logs

                    </div>

                    <div class="text-3xl font-bold mt-2">

                        {{ $userLogs }}

                    </div>

                </div>

            </div>

            {{-- Filter --}}

            <div class="bg-white rounded-xl shadow p-5 mb-6">

                <form method="GET">

                    <div class="grid grid-cols-1 md:grid-cols-6 gap-4">

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search User"
                            class="rounded-lg border-gray-300">

                        <select
                            name="module"
                            class="rounded-lg border-gray-300">

                            <option value="">

                                All Modules

                            </option>

                            <option value="Lead">

                                Lead

                            </option>

                            <option value="Task">

                                Task

                            </option>

                            <option value="FollowUp">

                                Follow Up

                            </option>

                            <option value="User">

                                User

                            </option>

                            <option value="Company">

                                Company

                            </option>

                            <option value="Report">

                                Report

                            </option>

                        </select>

                        <select
                            name="action"
                            class="rounded-lg border-gray-300">

                            <option value="">

                                All Actions

                            </option>

                            <option value="Created">

                                Created

                            </option>

                            <option value="Updated">

                                Updated

                            </option>

                            <option value="Deleted">

                                Deleted

                            </option>

                            <option value="Exported">

                                Exported

                            </option>

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

                        <button
                            class="bg-blue-600 hover:bg-blue-700 text-white rounded-lg">

                            Filter

                        </button>

                    </div>

                </form>

            </div>

            {{-- Table --}}

            <div class="bg-white rounded-xl shadow overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="px-5 py-3 text-left">

                                User

                            </th>

                            <th class="px-5 py-3">

                                Module

                            </th>

                            <th class="px-5 py-3">

                                Action

                            </th>

                            <th class="px-5 py-3">

                                Description

                            </th>

                            <th class="px-5 py-3">

                                Browser

                            </th>

                            <th class="px-5 py-3">

                                Platform

                            </th>

                            <th class="px-5 py-3">

                                IP

                            </th>

                            <th class="px-5 py-3">

                                Date

                            </th>
                            <th class="px-5 py-3 text-center">
                                Details
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($logs as $log)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-5 py-4">

                                {{ $log->user?->name }}

                            </td>

                            <td class="px-5 py-4 text-center">

                                {{ $log->module }}

                            </td>

                            <td class="px-5 py-4 text-center">

                                @switch($log->action)

                                    @case('Created')

                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">

                                            Created

                                        </span>

                                    @break

                                    @case('Updated')

                                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs">

                                            Updated

                                        </span>

                                    @break

                                    @case('Deleted')

                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs">

                                            Deleted

                                        </span>

                                    @break

                                    @default

                                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs">

                                            {{ $log->action }}

                                        </span>

                                @endswitch

                            </td>

                            <td class="px-5 py-4">


                                {{ $log->description }}


                            </td>

                            <td class="px-5 py-4 text-center">

                                {{ $log->browser }}

                            </td>

                            <td class="px-5 py-4 text-center">

                                {{ $log->platform }}

                            </td>

                            <td class="px-5 py-4 text-center">

                                {{ $log->ip_address }}

                            </td>

                            <td class="px-5 py-4 text-center">

                                {{ $log->created_at->format('d M Y h:i A') }}

                            </td>
                            <td class="px-5 py-4 text-center">

                                <button
                                    onclick="openAuditModal({{ $log->id }})"
                                    class="text-blue-600 hover:text-blue-800 font-semibold">

                                    View

                                </button>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="8" class="text-center py-10 text-gray-500">

                                No Audit Logs Found

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-6">

                {{ $logs->links() }}

            </div>

        </div>

    </div>
    <div id="auditModal"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

        <div class="bg-white rounded-xl shadow-xl w-11/12 max-w-5xl">

            <div class="flex justify-between items-center border-b p-5">

                <h2 class="text-xl font-bold">

                    Audit Details

                </h2>

                <button
                    onclick="closeAuditModal()"
                    class="text-gray-500 text-2xl">

                    &times;

                </button>

            </div>

            <div id="auditContent"
                class="p-6 overflow-auto max-h-[70vh]">

            </div>

        </div>

    </div>
<script>
const hiddenFields = [
    'id',
    'tenant_id',
    'user_id',
    'created_at',
    'updated_at',
    'deleted_at',
    'remember_token'
];
function openAuditModal(id){

    fetch('/audit-logs/'+id)

    .then(res=>res.json())

    .then(data=>{

        let html = `

        <div>

            <div class="flex items-center gap-3 mb-3">

                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">

                    ${data.module}

                </span>

                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">

                    ${data.action}

                </span>

            </div>



            <p class="text-gray-500 mb-6">

                ${data.description}

            </p>

            ${renderCompareTable(
                data.old_values,
                data.new_values
            )}

        </div>

        `;

        document
            .getElementById('auditContent')
            .innerHTML = html;

        document
            .getElementById('auditModal')
            .classList.remove('hidden');

        document
            .getElementById('auditModal')
            .classList.add('flex');

    });

}
function renderCompareTable(oldData = {}, newData = {}) {

    let html = `
        <table class="w-full border border-gray-200">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-3 text-left">

                        Field

                    </th>

                    <th class="p-3 text-left">

                        Old Value

                    </th>

                    <th class="p-3 text-left">

                        New Value

                    </th>

                </tr>

            </thead>

            <tbody>
    `;

    let keys = new Set([

        ...Object.keys(oldData || {}),

        ...Object.keys(newData || {})

    ]);

    keys.forEach(key=>{

        if(hiddenFields.includes(key))
            return;

        let oldValue = oldData?.[key] ?? '-';

        let newValue = newData?.[key] ?? '-';

        if(oldValue == newValue)
            return;

        html += `

            <tr>

                <td class="border p-2 font-semibold">

                    ${formatField(key)}

                </td>

                <td class="border p-2 bg-red-50">

                    ${oldValue}

                </td>

                <td class="border p-2 bg-green-50 font-semibold">

                    ${newValue}

                </td>

            </tr>

        `;

    });

    html += `

            </tbody>

        </table>

    `;

    return html;

}


function closeAuditModal(){

    document
        .getElementById('auditModal')
        .classList.add('hidden');

    document
        .getElementById('auditModal')
        .classList.remove('flex');

}

function formatField(field){

    return field
        .replaceAll('_',' ')
        .replace(/\b\w/g,c=>c.toUpperCase());

}

</script>
</x-app-layout>
