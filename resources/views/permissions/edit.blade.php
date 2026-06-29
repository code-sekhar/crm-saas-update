<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">

            Edit Permission

        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto">

        <div class="bg-white rounded-xl shadow p-8">

            <form
                action="{{ route('permissions.update',$permission) }}"
                method="POST">

                @csrf
                @method('PUT')

                <label
                    class="block font-semibold mb-2">

                    Permission Name

                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name',$permission->name) }}"
                    class="w-full rounded-lg border-gray-300">

                @error('name')

                    <p class="text-red-500 mt-2">

                        {{ $message }}

                    </p>

                @enderror

                <div class="mt-8 flex gap-3">

                    <a
                        href="{{ route('permissions.index') }}"
                        class="bg-gray-500 text-white px-5 py-2 rounded-lg">

                        Cancel

                    </a>

                    <button
                        class="bg-green-600 text-white px-5 py-2 rounded-lg">

                        Update Permission

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>
