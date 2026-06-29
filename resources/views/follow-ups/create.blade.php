<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl">
        Schedule Follow Up
    </h2>
</x-slot>

<div class="py-6">

    <div class=" mx-auto">

        <div class="bg-white shadow rounded-lg p-6">

            <h3 class="text-lg font-bold mb-6">

                Lead :
                <span class="text-blue-600">
                    {{ $lead->name }}
                </span>

            </h3>

            <form
                method="POST"
                action="{{ route('follow-ups.store') }}">

                @csrf

                <input
                    type="hidden"
                    name="lead_id"
                    value="{{ $lead->id }}">

                <div class="grid grid-cols-2 gap-5">

                    <div>

                        <label class="block mb-2">
                            Follow Up Date
                        </label>

                        <input
                            type="date"
                            name="follow_up_date"
                            class="w-full border rounded p-2"
                            required>

                    </div>

                    <div>

                        <label class="block mb-2">
                            Follow Up Time
                        </label>

                        <input
                            type="time"
                            name="follow_up_time"
                            class="w-full border rounded p-2">

                    </div>

                </div>

                <div class="mt-5">

                    <label class="block mb-2">

                        Remarks

                    </label>

                    <textarea
                        name="remarks"
                        rows="5"
                        class="w-full border rounded p-3"
                        placeholder="Example: Customer requested another demo next Monday..."></textarea>

                </div>

                <div class="mt-5">

                    <label class="block mb-2">

                        Priority

                    </label>

                    <select
                        name="priority"
                        class="w-full border rounded p-2">

                        <option value="Low">

                            Low

                        </option>

                        <option value="Medium">

                            Medium

                        </option>

                        <option value="High">

                            High

                        </option>

                    </select>

                </div>

                <div class="mt-6 flex gap-3">

                    <button
                        class="bg-indigo-600 text-white px-5 py-2 rounded">

                        Schedule Follow Up

                    </button>

                    <a
                        href="{{ route('leads.show',$lead->id) }}"
                        class="bg-gray-500 text-white px-5 py-2 rounded">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

</x-app-layout>
