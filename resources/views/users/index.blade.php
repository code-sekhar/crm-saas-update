<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">
            User Management
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto">

        <div class="flex justify-between items-center mb-6">

            <form method="GET">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search user..."
                    class="w-72 rounded-lg border-gray-300">

            </form>

            <a
                href="{{ route('users.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                <i class="fa-solid fa-plus mr-2"></i>

                Create User

            </a>

        </div>

        @if(session('success'))

            <div class="mb-5 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">

                {{ session('success') }}

            </div>

        @endif

        <div class="bg-white rounded-xl shadow overflow-hidden">

            <table class="min-w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-3 text-left">#</th>

                        <th class="px-6 py-3 text-left">Avatar</th>

                        <th class="px-6 py-3 text-left">Name</th>

                        <th class="px-6 py-3 text-left">Email</th>

                        <th class="px-6 py-3 text-left">Phone</th>

                        <th class="px-6 py-3 text-left">Role</th>

                        <th class="px-6 py-3 text-left">Status</th>

                        <th class="px-6 py-3 text-left">Last Login</th>

                        <th class="px-6 py-3 text-center">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($users as $user)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-6 py-4">

                                {{ $loop->iteration }}

                            </td>

                            <td class="px-6 py-4">

                                <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">

                                    {{ strtoupper(substr($user->name,0,1)) }}

                                </div>

                            </td>

                            <td class="px-6 py-4 font-semibold">

                                {{ $user->name }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $user->email }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $user->phone ?? '-' }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $user->roles->first()?->name ?? '-' }}

                            </td>

                            <td class="px-6 py-4">

                                @if($user->status)

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                        Active

                                    </span>

                                @else

                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

                                        Inactive

                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4">

                                {{ $user->last_login_at?->diffForHumans() ?? 'Never' }}

                            </td>

                            <td class="px-6 py-4 text-center">

                                <a
                                    href="{{ route('users.edit',$user) }}"
                                    class="bg-indigo-600 text-white px-3 py-2 rounded">

                                    <i class="fa-solid fa-pen"></i>

                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('users.destroy',$user) }}"
                                    class="inline">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Delete User?')"
                                        class="bg-red-600 text-white px-3 py-2 rounded">

                                        <i class="fa-solid fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9" class="text-center py-8 text-gray-500">

                                No Users Found

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-6">

            {{ $users->links() }}

        </div>

    </div>

</x-app-layout>
