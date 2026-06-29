<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lead Details
        </h2>
    </x-slot>

    <div class="py-6">
        <div class=" mx-auto sm:px-4 lg:px-4">

            <!-- Lead Information -->
            <div class="bg-white shadow rounded-lg p-6 mb-6">

                <h3 class="text-lg font-bold mb-6 border-b pb-3">
                    Lead Information
                </h3>

                <div class="grid grid-cols-2 gap-6">

                    <div>
                        <p class="text-gray-500 text-sm">Name</p>
                        <p class="font-semibold">{{ $lead->name }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">Email</p>
                        <p>{{ $lead->email }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">Phone</p>
                        <p>{{ $lead->phone }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">Source</p>
                        <p>{{ $lead->source }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">Status</p>

                        <span class="px-3 py-1 rounded bg-blue-500 text-white">
                            {{ $lead->status }}
                        </span>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">Created At</p>
                        <p>{{ $lead->created_at->format('d M Y h:i A') }}</p>
                    </div>

                </div>

            </div>

            <!-- Tasks -->
            <div class="bg-white shadow rounded-lg p-6 mb-6">

                <div class="flex justify-between items-center mb-4">

                    <h3 class="text-lg font-bold">
                        Tasks
                    </h3>

                    <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded">
                        Add Task
                    </a>

                </div>
                @if($lead->tasks->count())

                <table class="w-full border">

                    <thead>

                    <tr>

                        <th class="border p-2">
                            Title
                        </th>

                        <th class="border p-2">
                            Due Date
                        </th>

                        <th class="border p-2">
                            Status
                        </th>

                    </tr>

                    </thead>

                    <tbody>

                    @foreach($lead->tasks as $task)

                    <tr>

                        <td class="border p-2">
                            {{ $task->title }}
                        </td>

                        <td class="border p-2">
                            {{ $task->due_date }}
                        </td>

                        <td class="border p-2">
                            {{ $task->status }}
                        </td>

                    </tr>

                    @endforeach

                    </tbody>

                </table>

                @else

                <p class="text-gray-500">
                    No tasks available.
                </p>

                @endif


            </div>

            <!-- Notes -->
            {{-- <div class="bg-white shadow rounded-lg p-6 mb-6">

                <div class="flex justify-between items-center mb-4">

                    <h3 class="text-lg font-bold">
                        Notes
                    </h3>

                    <a href="#" class="bg-green-600 text-white px-4 py-2 rounded">
                        Add Note
                    </a>

                </div>

                @if($lead->leadNotes->count())

                    @foreach($lead->leadNotes as $note)

                        {{ $note->note }}

                        {{ $note->user->name }}

                        {{ $note->created_at->diffForHumans() }}

                    @endforeach

                @else

                No Notes

                @endif

            </div> --}}

            <!-- Notes -->

            <div class="bg-white shadow rounded-lg p-6 mb-6">

                <h3 class="text-lg font-bold mb-4">
                    Notes
                </h3>

                <form method="POST"
                    action="{{ route('lead-notes.store') }}">

                    @csrf

                    <input
                        type="hidden"
                        name="lead_id"
                        value="{{ $lead->id }}">

                    <textarea
                        name="note"
                        rows="3"
                        class="w-full border rounded p-3"
                        placeholder="Write your note..."></textarea>

                    <button
                        class="mt-3 bg-green-600 text-white px-4 py-2 rounded">

                        Add Note

                    </button>

                </form>

                <hr class="my-5">

                <div class="grid grid-cols-2 gap-4">
                    @forelse($lead->leadNotes as $note)

                        <div class="border rounded p-4 mb-4">

                            <div id="view-{{ $note->id }}">

                                <div class="mt-2 text-gray-700">
                                    {{ $note->note }}
                                </div>

                                <div class="mt-3 flex gap-4">

                                    <button
                                        type="button"
                                        onclick="editNote({{ $note->id }})"
                                        class="text-blue-600">

                                        Edit

                                    </button>

                                    <form
                                        method="POST"
                                        action="{{ route('lead-notes.destroy',$note) }}">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="text-red-600">

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </div>
                            <div
                                id="edit-{{ $note->id }}"
                                class="hidden">

                                <form
                                    method="POST"
                                    action="{{ route('lead-notes.update',$note) }}">

                                    @csrf
                                    @method('PUT')

                                    <textarea
                                        name="note"
                                        rows="3"
                                        class="w-full border rounded p-2">{{ $note->note }}</textarea>

                                    <div class="mt-3">

                                        <button
                                            class="bg-blue-600 text-white px-3 py-1 rounded">

                                            Save

                                        </button>

                                        <button
                                            type="button"
                                            onclick="cancelEdit({{ $note->id }})"
                                            class="bg-gray-500 text-white px-3 py-1 rounded ml-2">

                                            Cancel

                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    @empty

                        <p class="text-gray-500">
                            No Notes Yet.
                        </p>

                    @endforelse
                </div>

            </div>

            <!-- Follow Ups -->

            <div class="bg-white shadow rounded-lg p-6 mb-6">

                <div class="flex justify-between items-center mb-4">

                    <h3 class="text-lg font-bold">
                        Follow Ups
                    </h3>

                   <a  href="{{ route('follow-ups.create', ['lead' => $lead->id]) }}"
                    class="bg-indigo-600 text-white px-4 py-2 rounded">

                    Add Follow Up

                </a>

                </div>

                @forelse($lead->followUps as $followUp)

                    <div class="border rounded-lg p-4 mb-3">

                        <div class="flex justify-between">

                            <div>

                                <p class="font-semibold">

                                    {{ $followUp->follow_up_date }}

                                    @if($followUp->follow_up_time)

                                        {{ $followUp->follow_up_time }}

                                    @endif

                                </p>

                                <p class="text-gray-600 mt-2">

                                    {{ $followUp->remarks }}

                                </p>

                            </div>

                            {{-- <div>

                                @if($followUp->status == 'Pending')

                                    <span class="bg-yellow-500 text-white px-3 py-1 rounded">
                                        Pending
                                    </span>

                                @elseif($followUp->status == 'Completed')

                                    <span class="bg-green-600 text-white px-3 py-1 rounded">
                                        Completed
                                    </span>

                                @else

                                    <span class="bg-red-600 text-white px-3 py-1 rounded">
                                        Missed
                                    </span>

                                @endif

                            </div> --}}
                            <div class="flex flex-col items-end gap-2">

                                @if($followUp->status == 'Pending')

                                    <span
                                        class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">

                                        Pending

                                    </span>

                                @elseif($followUp->status == 'Completed')

                                    <span
                                        class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">

                                        Completed

                                    </span>

                                @else

                                    <span
                                        class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">

                                        Missed

                                    </span>

                                @endif
                                 {{-- Priority Badge --}}
                                @if($followUp->priority == 'High')

                                    <span class="px-3 py-1 text-xs rounded-full bg-red-600 text-white">
                                        High
                                    </span>

                                @elseif($followUp->priority == 'Medium')

                                    <span class="px-3 py-1 text-xs rounded-full bg-yellow-500 text-white">
                                        Medium
                                    </span>

                                @else

                                    <span class="px-3 py-1 text-xs rounded-full bg-green-600 text-white">
                                        Low
                                    </span>

                                @endif

                            </div>


                        </div>

                        <div class="text-sm text-gray-500 mt-3">

                            By:
                            {{ $followUp->user->name }}
                            <div class="flex gap-2">
                                {{-- <form
                                    method="POST"
                                    action="{{ route('follow-ups.destroy',$followUp) }}"
                                    class="mt-3">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Delete this Follow-up?')"
                                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded-lg text-sm">

                                        <i class="fa-regular fa-trash-can"></i> Delete

                                    </button>

                                </form> --}}
                                <form
                                    id="delete-form-{{ $followUp->id }}"
                                    method="POST"
                                    action="{{ route('follow-ups.destroy',$followUp) }}">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="button"
                                        onclick="deleteFollowUp({{ $followUp->id }})"
                                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">

                                        <i class="fa-solid fa-trash"></i>
                                        Delete

                                    </button>

                                </form>
                                @if($followUp->status == 'Pending')


                                    <form  method="POST" action="{{ route('follow-ups.complete',$followUp) }}" class="mt-3">

                                        @csrf
                                        @method('PUT')

                                        <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">

                                            ✓ Mark Completed

                                        </button>

                                    </form>

                                @endif
                            </div>

                        </div>

                    </div>


                @empty

                    <div class="text-gray-500">

                        No Follow Ups Found.

                    </div>

                @endforelse


            </div>



            {{-- <!-- Activity -->
            <div class="bg-white shadow rounded-lg p-6">

                <h3 class="text-lg font-bold mb-4">
                    Activity Timeline
                </h3>

                <ul class="space-y-3">

                    <li class="border-l-4 border-blue-500 pl-4">
                        Lead Created
                    </li>

                </ul>

            </div> --}}
            <!-- Activity Timeline -->

            <div class="bg-white shadow-lg rounded-xl p-6 mt-8">

                <div class="flex justify-between items-center border-b pb-4 mb-6">

                    <h2 class="text-xl font-bold text-gray-800">
                        Activity Timeline
                    </h2>

                    <span class="bg-indigo-100 text-indigo-700 text-sm px-4 py-1 rounded-full">
                        {{ $lead->activities->count() }} Activities
                    </span>

                </div>

                @forelse($lead->activities as $activity)

                    <div class="relative flex pb-8">

                        @if(!$loop->last)
                            <div class="absolute left-5 top-10 h-full w-0.5 bg-gray-200"></div>
                        @endif

                        <!-- Icon -->
                        <div class="flex-shrink-0 z-10">

                            @php
                                $bg='bg-gray-500';
                                $icon='•';

                                switch($activity->action){

                                    case 'lead_created':
                                        $bg='bg-green-500';
                                        $icon='➕';
                                        break;

                                    case 'note_added':
                                        $bg='bg-blue-500';
                                        $icon='📝';
                                        break;

                                    case 'followup_added':
                                        $bg='bg-yellow-500';
                                        $icon='<i class="fa-regular fa-calendar"></i>';
                                        break;

                                    case 'followup_completed':
                                          $bg = 'bg-green-600';
                                          $icon = '<i class="fa-regular fa-circle-check"></i>';
                                          break;

                                    case 'followup_deleted':
                                          $bg='bg-red-600';
                                          $icon='<i class="fa-solid fa-trash"></i>';
                                          break;

                                    case 'followup_overdue':
                                          $bg='bg-red-600';
                                          $icon='<i class="fa-solid fa-clock"></i>';
                                          break;

                                    case 'followup_rescheduled':
                                          $bg = 'bg-indigo-500';
                                          $icon = '<i class="fa-solid fa-arrows-rotate"></i>';
                                          break;

                                    case 'task_created':
                                        $bg='bg-purple-500';
                                        $icon='✔';
                                        break;

                                    case 'task_completed':
                                        $bg='bg-green-600';
                                        $icon='✓';
                                        break;

                                    case 'status_changed':
                                        $bg='bg-red-500';
                                        $icon='⇄';
                                        break;

                                }
                            @endphp

                            {{-- <div class="w-10 h-10 rounded-full {{ $bg }} flex items-center justify-center text-white text-lg shadow">
                                {{ $icon }}
                            </div> --}}
                            <div class="w-10 h-10 rounded-full {{ $bg }} flex items-center justify-center text-white text-lg shadow">
                                {!! $icon !!}
                            </div>

                        </div>

                        <!-- Content -->

                        <div class="ml-5 flex-1">

                            <div class="flex justify-between">

                                <div>
                                    @php
                                    $title = match($activity->action){
                                        'lead_created'        => 'Lead Created',
                                        'note_added'          => 'Note Added',
                                        'followup_added'      => 'Follow-up Added',
                                        'followup_completed'  => 'Follow-up Completed',
                                        'task_created'        => 'Task Created',
                                        'task_completed'      => 'Task Completed',
                                        'status_changed'      => 'Status Changed',
                                        'followup_deleted' => 'Follow-up Deleted',
                                        default               => ucwords(str_replace('_',' ',$activity->action)),
                                    };
                                    @endphp

                                    <h4 class="font-semibold text-gray-900">
                                        {{ $title }}
                                    </h4>

                                    {{-- <h4 class="font-semibold text-gray-900">

                                        {{ ucwords(str_replace('_',' ',$activity->action)) }}

                                    </h4> --}}

                                    <p class="text-gray-600 mt-1">

                                        {{ $activity->description }}

                                    </p>

                                    <div class="mt-2 text-sm text-gray-400">

                                        By
                                        <span class="font-medium text-gray-600">
                                            {{ $activity->user->name }}
                                        </span>

                                    </div>

                                </div>

                                <div class="text-sm text-gray-400 whitespace-nowrap">

                                    {{-- {{ $activity->created_at->diffForHumans() }} --}}
                                    <span class="bg-gray-100 text-gray-500 text-xs px-3 py-1 rounded-full">

                                        {{ $activity->created_at->diffForHumans() }}

                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="text-center py-10">

                        <div class="text-6xl mb-3">
                            📜
                        </div>

                        <h3 class="text-lg font-semibold text-gray-600">

                            No Activity Yet

                        </h3>

                        <p class="text-gray-400 mt-2">

                            Activities will appear here automatically.

                        </p>

                    </div>

                @endforelse

            </div>

        </div>
    </div>
<script>

function editNote(id)
{
    document
        .getElementById('view-'+id)
        .classList.add('hidden');

    document
        .getElementById('edit-'+id)
        .classList.remove('hidden');
}

function cancelEdit(id)
{
    document
        .getElementById('edit-'+id)
        .classList.add('hidden');

    document
        .getElementById('view-'+id)
        .classList.remove('hidden');
}


function deleteFollowUp(id)
{
    Swal.fire({

        title: 'Delete Follow-up?',

        text: "This action cannot be undone.",

        icon: 'warning',

        showCancelButton: true,

        confirmButtonColor: '#dc2626',

        cancelButtonColor: '#6b7280',

        confirmButtonText: 'Yes, Delete',

        cancelButtonText: 'Cancel'

    }).then((result) => {

        if(result.isConfirmed){

            document
                .getElementById('delete-form-'+id)
                .submit();

        }

    });
}

</script>
</x-app-layout>
