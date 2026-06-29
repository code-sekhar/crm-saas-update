<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">
            Edit Role
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto">

        <div class="bg-white rounded-xl shadow">

            <div class="border-b px-6 py-4">

                <h3 class="text-xl font-semibold">

                    Edit Role

                </h3>

                <p class="text-gray-500 text-sm mt-1">

                    Update role name and permissions.

                </p>

            </div>

            <form
                action="{{ route('roles.update',$role) }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="p-6">

                    {{-- Role Name --}}

                    <div class="mb-8">

                        <label class="block font-semibold mb-2">

                            Role Name

                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name',$role->name) }}"
                            class="w-full rounded-lg border-gray-300 focus:ring-blue-500">

                        @error('name')

                            <p class="text-red-500 text-sm mt-2">

                                {{ $message }}

                            </p>

                        @enderror

                    </div>

                    {{-- Permissions --}}

                    <div>

                        <div class="flex justify-between items-center mb-5">

                            <h4 class="text-lg font-semibold">

                                Permissions

                            </h4>

                            <button
                                type="button"
                                id="selectAll"
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg">

                                Select All

                            </button>

                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                            @foreach($permissions as $permission)

                                <label
                                    class="flex items-center gap-3 border rounded-lg p-3 hover:bg-gray-50 cursor-pointer">

                                    <input
                                        type="checkbox"
                                        name="permissions[]"
                                        value="{{ $permission->name }}"
                                        class="permission-checkbox rounded"

                                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>

                                    <span>

                                        {{ ucwords(str_replace(['-','.'],' ',$permission->name)) }}

                                    </span>

                                </label>

                            @endforeach

                        </div>

                    </div>

                </div>

                <div class="border-t px-6 py-4 flex justify-end gap-3">

                    <a
                        href="{{ route('roles.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

                        Cancel

                    </a>

                    <button
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">

                        Update Role

                    </button>

                </div>

            </form>

        </div>

    </div>

<script>

const selectAllBtn = document.getElementById('selectAll');

selectAllBtn.addEventListener('click', function(){

    const checkboxes = document.querySelectorAll('.permission-checkbox');

    const allChecked = [...checkboxes].every(cb => cb.checked);

    checkboxes.forEach(cb => {

        cb.checked = !allChecked;

    });

    this.innerHTML = allChecked
        ? 'Select All'
        : 'Unselect All';

});

</script>

</x-app-layout>
