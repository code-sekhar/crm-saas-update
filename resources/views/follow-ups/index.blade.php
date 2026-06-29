<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800">
        Follow Up Management
    </h2>
</x-slot>

<div class="py-6">

    <div class="  mx-auto sm:px-4 lg:px-4">

        <div class="bg-white shadow rounded-lg p-6">

            <div class="flex justify-between items-center mb-6">

                <h3 class="text-xl font-bold">

                    All Follow Ups

                </h3>

            </div>

            <table class="min-w-full border">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="border p-3">Lead</th>

                        <th class="border p-3">Date</th>

                        <th class="border p-3">Time</th>

                        <th class="border p-3">Priority</th>

                        <th class="border p-3">Status</th>

                        <th class="border p-3">Assigned By</th>

                        <th class="border p-3">Action</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($followUps as $followUp)

                    <tr>

                        <td class="border p-3">

                            {{ $followUp->lead->name }}

                        </td>

                        <td class="border p-3">

                            {{ \Carbon\Carbon::parse($followUp->follow_up_date)->format('d M Y') }}

                        </td>

                        <td class="border p-3">

                            {{ $followUp->follow_up_time }}

                        </td>

                        <td class="border p-3">

                            @if($followUp->priority=='High')

                                <span class="bg-red-500 text-white px-2 py-1 rounded-full text-xs">
                                    High
                                </span>

                            @elseif($followUp->priority=='Medium')

                                <span class="bg-yellow-500 text-white px-2 py-1 rounded-full text-xs">
                                    Medium
                                </span>

                            @else

                                <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs">
                                    Low
                                </span>

                            @endif

                        </td>

                        <td class="border p-3">

                            @if($followUp->status=='Pending')

                                <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">
                                    Pending
                                </span>

                            @elseif($followUp->status=='Completed')

                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">
                                    Completed
                                </span>

                            @else

                                <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs">
                                    Missed
                                </span>

                            @endif

                        </td>

                        <td class="border p-3">

                            {{ $followUp->user->name }}

                        </td>

                        <td class="border p-3">

                            <div class="flex gap-2 justify-center">

                                <a
                                    href="{{ route('leads.show',$followUp->lead_id) }}"
                                    class="bg-blue-600 text-white px-3 py-1 rounded text-sm">

                                    View

                                </a>

                                <a
                                    href="{{ route('follow-ups.edit',$followUp) }}"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">

                                    Edit

                                </a>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7"
                            class="text-center py-8 text-gray-500">

                            No Follow Ups Found

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-app-layout>
