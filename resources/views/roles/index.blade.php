<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">
            Roles & Permissions
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto">

        <!-- Header -->

        <div class="flex justify-between items-center mb-6">

            <form method="GET">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search Role..."
                    class="rounded-lg border-gray-300 w-72">

            </form>

            <a
                href="{{ route('roles.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                <i class="fa-solid fa-plus mr-2"></i>

                Create Role

            </a>

        </div>

        <!-- Success -->

        @if(session('success'))

            <div class="mb-5 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">

                {{ session('success') }}

            </div>

        @endif

        <!-- Table -->

        <div class="bg-white rounded-xl shadow overflow-hidden">

            <table class="min-w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="text-left px-6 py-3">
                            #
                        </th>

                        <th class="text-left px-6 py-3">
                            Role Name
                        </th>

                        <th class="text-left px-6 py-3">
                            Permissions
                        </th>

                        <th class="text-left px-6 py-3">
                            Created
                        </th>

                        <th class="text-center px-6 py-3">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($roles as $role)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-6 py-4">

                                {{ $loop->iteration }}

                            </td>

                            <td class="px-6 py-4 font-semibold">

                                {{ ucfirst($role->name) }}

                            </td>

                            <td class="px-6 py-4">

                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">

                                    {{ $role->permissions_count }}

                                    Permissions

                                </span>

                            </td>

                            <td class="px-6 py-4">

                                {{ $role->created_at->format('d M Y') }}

                            </td>

                            <td class="px-6 py-4 text-center">

                                <a
                                    href="{{ route('roles.edit',$role) }}"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded">

                                    <i class="fa-solid fa-pen"></i>

                                </a>

                                <form
                                    action="{{ route('roles.destroy',$role) }}"
                                    method="POST"
                                    class="inline">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Delete this role?')"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded">

                                        <i class="fa-solid fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="text-center py-10 text-gray-500">

                                No Roles Found

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- Pagination -->

        <div class="mt-6">

            {{ $roles->links() }}

        </div>

    </div>

</x-app-layout>
