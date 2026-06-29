<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">
            Permissions
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto">

        <div class="flex justify-between mb-6">

            <form>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search Permission..."
                    class="w-72 rounded-lg border-gray-300">

            </form>

            <a
                href="{{ route('permissions.create') }}"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg">

                + Create Permission

            </a>

        </div>

        @if(session('success'))

            <div
                class="mb-5 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded">

                {{ session('success') }}

            </div>

        @endif

        <div class="bg-white rounded-xl shadow overflow-hidden">

            <table class="min-w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-3 text-left">
                            #
                        </th>

                        <th class="px-6 py-3 text-left">
                            Permission
                        </th>

                        <th class="px-6 py-3 text-left">
                            Created
                        </th>

                        <th class="px-6 py-3 text-center">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($permissions as $permission)

                        <tr class="border-b">

                            <td class="px-6 py-4">

                                {{ $loop->iteration }}

                            </td>

                            <td class="px-6 py-4 font-semibold">

                                {{ $permission->name }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $permission->created_at->format('d M Y') }}

                            </td>

                            <td class="px-6 py-4 text-center">

                                <a
                                    href="{{ route('permissions.edit',$permission) }}"
                                    class="bg-blue-600 text-white px-3 py-2 rounded">

                                    Edit

                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('permissions.destroy',$permission) }}"
                                    class="inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Delete Permission?')"
                                        class="bg-red-600 text-white px-3 py-2 rounded">

                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="4"
                                class="text-center py-8 text-gray-500">

                                No Permission Found

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-6">

            {{ $permissions->links() }}

        </div>

    </div>

</x-app-layout>
