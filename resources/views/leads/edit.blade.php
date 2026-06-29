<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl">
        Update Lead
    </h2>
</x-slot>

<div class="py-6">
    <div class=" sm:px-4 lg:px-4">

    <div class="bg-white shadow rounded-lg p-6">

        <form method="POST"
              action="{{ route('leads.update', $lead->id) }}">

            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>Name</label>

                <input
                    type="text"
                    name="name"
                    value="{{ $lead->name }}"
                    class="w-full border rounded p-2"
                    required>
            </div>

            <div class="mb-4">
                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    value="{{ $lead->email }}"
                    class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label>Phone</label>

                <input
                    type="text"
                    name="phone"
                    value="{{ $lead->phone }}"
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

                <select
                    name="source"
                    class="w-full border rounded p-2">

                    <option value="Facebook"
                        {{ $lead->source == 'Facebook' ? 'selected' : '' }}>
                        Facebook
                    </option>

                    <option value="Google"
                        {{ $lead->source == 'Google' ? 'selected' : '' }}>
                        Google
                    </option>

                    <option value="Website"
                        {{ $lead->source == 'Website' ? 'selected' : '' }}>
                        Website
                    </option>

                    <option value="Referral"
                        {{ $lead->source == 'Referral' ? 'selected' : '' }}>
                        Referral
                    </option>

                    <option value="WhatsApp"
                        {{ $lead->source == 'WhatsApp' ? 'selected' : '' }}>
                        WhatsApp
                    </option>

                </select>
            </div>

            <div class="mb-4">
                <label>Status</label>

                <select
                    name="status"
                    class="w-full border rounded p-2">

                    <option value="New"
                        {{ $lead->status == 'New' ? 'selected' : '' }}>
                        New
                    </option>

                    <option value="Contacted"
                        {{ $lead->status == 'Contacted' ? 'selected' : '' }}>
                        Contacted
                    </option>

                    <option value="Qualified"
                        {{ $lead->status == 'Qualified' ? 'selected' : '' }}>
                        Qualified
                    </option>


                    <option value="Proposal"
                        {{ $lead->status == 'Proposal' ? 'selected' : '' }}>
                        Proposal
                    </option>

                    <option value="Negotiation"
                        {{ $lead->status == 'Negotiation' ? 'selected' : '' }}>
                        Negotiation
                    </option>

                    <option value="Won"
                        {{ $lead->status == 'Won' ? 'selected' : '' }}>
                        Won
                    </option>

                    <option value="Lost"
                        {{ $lead->status == 'Lost' ? 'selected' : '' }}>
                        Lost
                    </option>

                </select>
            </div>

            <button
                type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded">

                Update Lead

            </button>

        </form>

    </div>

</div>


</div>

</x-app-layout>
