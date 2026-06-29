<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl">
        Tasks
    </h2>
</x-slot>

<div class="py-6">

<div class=" mx-auto">

    <div class="bg-white shadow rounded p-6">

        <div class="flex justify-between mb-4">

            <h3 class="font-bold">
                All Tasks
            </h3>

            <a href="{{ route('tasks.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded">
                Add Task
            </a>

        </div>

        <table class="w-full border">

            <thead>

            <tr>
                <th class="border p-2">Title</th>
                <th class="border p-2">Due Date</th>
                <th class="border p-2">Status</th>
            </tr>

            </thead>

            <tbody>

            @foreach($tasks as $task)

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

    </div>

</div>


</div>

</x-app-layout>
