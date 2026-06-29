<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl">
        Create Lead
    </h2>
</x-slot>

<div class="py-6">
    <div class="  mx-auto sm:px-4 lg:px-4">

        <div class="bg-white shadow rounded-lg p-6">

            <form method="POST" action="{{ route('leads.store') }}">
                @csrf

                <div class="mb-4">
                    <label>Name</label>
                    <input type="text"
                           name="name"
                           class="w-full border rounded p-2"
                           required>
                </div>

                <div class="mb-4">
                    <label>Email</label>
                    <input type="email"
                           name="email"
                           class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label>Phone</label>
                    <input type="text"
                           name="phone"
                           class="w-full border rounded p-2">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Lead Value
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="value"
                        value="{{ old('value', $lead->value ?? '') }}"
                        class="w-full border rounded-lg px-3 py-2"
                        placeholder="50000">
                </div>

                <div class="mb-4">
                    <label>Source</label>
                    <select name="source"
                            class="w-full border rounded p-2">
                        <option>Facebook</option>
                        <option>Google</option>
                        <option>Website</option>
                        <option>Referral</option>
                        <option>WhatsApp</option>
                    </select>
                </div>

                <button
                    type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded">
                    Save Lead
                </button>

            </form>

        </div>

    </div>
</div>


</x-app-layout>
