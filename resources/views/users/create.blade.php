<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">
            Create User
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto">

        <div class="bg-white rounded-xl shadow">

            <div class="border-b px-6 py-4">

                <h3 class="text-xl font-semibold">
                    New User
                </h3>

                <p class="text-gray-500 mt-1">
                    Create a new CRM user.
                </p>

            </div>

            <form
                action="{{ route('users.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">

                    {{-- Name --}}

                    <div>

                        <label class="block font-semibold mb-2">
                            Full Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="w-full rounded-lg border-gray-300"
                            required>

                        @error('name')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Email --}}

                    <div>

                        <label class="block font-semibold mb-2">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="w-full rounded-lg border-gray-300"
                            required>

                        @error('email')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Phone --}}

                    <div>

                        <label class="block font-semibold mb-2">
                            Phone
                        </label>

                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone') }}"
                            class="w-full rounded-lg border-gray-300">

                    </div>

                    {{-- Role --}}

                    <div>

                        <label class="block font-semibold mb-2">
                            Role
                        </label>

                        <select
                            name="role"
                            class="w-full rounded-lg border-gray-300">

                            @foreach($roles as $role)

                                <option value="{{ $role->name }}">

                                    {{ ucfirst($role->name) }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- Password --}}

                    <div>

                        <label class="block font-semibold mb-2">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="w-full rounded-lg border-gray-300"
                            required>

                    </div>

                    {{-- Confirm Password --}}

                    <div>

                        <label class="block font-semibold mb-2">
                            Confirm Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="w-full rounded-lg border-gray-300"
                            required>

                    </div>

                    {{-- Status --}}

                    <div>

                        <label class="block font-semibold mb-2">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full rounded-lg border-gray-300">

                            <option value="1">
                                Active
                            </option>

                            <option value="0">
                                Inactive
                            </option>

                        </select>

                    </div>

                    {{-- Avatar --}}

                    <div>

                        <label class="block font-semibold mb-2">
                            Avatar
                        </label>

                        <input
                            type="file"
                            name="avatar"
                            id="avatar"
                            accept="image/*"
                            class="w-full rounded-lg border-gray-300">

                    </div>

                </div>

                {{-- Preview --}}

                <div class="px-6">

                    <img
                        id="preview"
                        src="https://placehold.co/120x120"
                        class="w-28 h-28 rounded-full border object-cover">

                </div>

                <div class="border-t mt-6 px-6 py-5 flex justify-end gap-3">

                    <a
                        href="{{ route('users.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

                        Cancel

                    </a>

                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">

                        Save User

                    </button>

                </div>

            </form>

        </div>

    </div>

<script>

document.getElementById('avatar').addEventListener('change',function(e){

    const file=e.target.files[0];

    if(file){

        document.getElementById('preview').src=URL.createObjectURL(file);

    }

});

</script>

</x-app-layout>
