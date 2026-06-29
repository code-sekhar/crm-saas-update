<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl">
        Leads
    </h2>
</x-slot>

<div class="py-6">

    <div class=" mx-auto sm:px-4 lg:px-4">
        @if(session('success'))

            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>

        @endif
        <div class="bg-white shadow rounded-lg">

            <div class="p-6">

                <div class="flex justify-between mb-4">

                    <h3 class="text-lg font-bold">
                        All Leads
                    </h3>

                    <a href="/leads/create"
                       class="px-4 py-2 bg-blue-600 text-white rounded">
                        Add Lead
                    </a>

                </div>

                <table class="w-full border" id="leadTable" >

                    <thead>

                    <tr class="bg-gray-100">

                        <th class="p-3 border">ID</th>
                        <th class="p-3 border">Name</th>
                        <th class="p-3 border">Email</th>
                        <th class="p-3 border">Phone</th>
                        <th class="p-3 border">Source</th>
                        <th class="p-3 border">Status</th>
                        <th>Action</th>

                    </tr>

                    </thead>

                    <tbody>

                    @foreach($leads as $lead)

                        <tr>

                            <td class="border p-2">
                                {{ $lead->id }}
                            </td>

                            <td class="border p-2">
                                {{ $lead->name }}
                            </td>

                            <td class="border p-2">
                                {{ $lead->email }}
                            </td>

                            <td class="border p-2">
                                {{ $lead->phone }}
                            </td>

                            <td class="border p-2">
                                {{ $lead->source }}
                            </td>

                            <td class="border p-2">
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
                            <td class="border p-2 d-flex gap-3 ">
                                <div class="d-flex gap-3 justify-content-center full-width">
                                    <a href="{{ route('leads.edit',$lead) }}" class="bg-yellow-600 text-white px-2 py-1 rounded cursor-pointer">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <a href="{{ route('leads.show', $lead->id) }}" class="bg-green-600 text-white px-2 py-1 mx-2 rounded cursor-pointer">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('leads.destroy',$lead) }}"
                                        style="display:inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded cursor-pointer">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>

                                    </form>
                                </div>
                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>
  <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function () {

    $('#leadTable').DataTable();

});
</script>

</x-app-layout>

