<x-app-layout>

    <x-slot name="header">

        <h2 class="text-xl font-semibold">

Edit Follow Up

</h2>

    </x-slot>

    <div class="py-6">

        <div class=" mx-auto">

            <div class="bg-white shadow rounded-lg p-6">

                <form method="POST" action="{{ route('follow-ups.update',$followUp) }}">

                    @csrf @method('PUT')

                    <div class="grid grid-cols-2 gap-5">

                        <div>

                            <label>

                                Date

                            </label>

                            <input type="date" name="follow_up_date" value="{{ $followUp->follow_up_date }}" class="w-full border rounded p-2">

                        </div>

                        <div>

                            <label>

                                Time

                            </label>

                            <input type="time" name="follow_up_time" value="{{ $followUp->follow_up_time }}" class="w-full border rounded p-2">

                        </div>

                    </div>

                    <div class="mt-5">

                        <label>

                            Priority

                        </label>

                        <select name="priority" class="w-full border rounded p-2">

                            <option value="Low" {{ $followUp->priority=='Low'?'selected':'' }}> Low

                            </option>

                            <option value="Medium" {{ $followUp->priority=='Medium'?'selected':'' }}> Medium

                            </option>

                            <option value="High" {{ $followUp->priority=='High'?'selected':'' }}> High

                            </option>

                        </select>

                    </div>

                    <div class="mt-5">

                        <label>

                            Status

                        </label>

                        <select name="status" class="w-full border rounded p-2">

                            <option value="Pending" {{ $followUp->status=='Pending'?'selected':'' }}> Pending

                            </option>

                            <option value="Completed" {{ $followUp->status=='Completed'?'selected':'' }}> Completed

                            </option>

                            <option value="Missed" {{ $followUp->status=='Missed'?'selected':'' }}> Missed

                            </option>

                        </select>

                    </div>

                    <div class="mt-5">

                        <label>

                            Remarks

                        </label>

                        <textarea name="remarks" rows="5" class="w-full border rounded p-3">{{ $followUp->remarks }}</textarea>

                    </div>

                    <div class="mt-6">

                        <button class="bg-blue-600 text-white px-5 py-2 rounded">

                            Update Follow Up

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
