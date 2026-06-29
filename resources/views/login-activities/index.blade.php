@php
use Illuminate\Support\Facades\Storage;
@endphp
<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">
            Login Activity
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto">

        {{-- Filter Card --}}

        <div class="bg-white rounded-xl shadow p-5 mb-6">

            <form
                method="GET"
                class="grid md:grid-cols-4 gap-4">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search User..."
                    class="rounded-lg border-gray-300">

                <input
                    type="date"
                    name="from"
                    value="{{ request('from') }}"
                    class="rounded-lg border-gray-300">

                <input
                    type="date"
                    name="to"
                    value="{{ request('to') }}"
                    class="rounded-lg border-gray-300">

                <div class="flex gap-2">

                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 rounded-lg">

                        Filter

                    </button>

                    <a
                        href="{{ route('login-activities.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-5 rounded-lg flex items-center">

                        Reset

                    </a>

                </div>

            </form>

        </div>

        {{-- Table --}}

        <div class="bg-white rounded-xl shadow overflow-hidden">

            <div class="px-6 py-4 border-b">

                <h3 class="text-xl font-bold">

                    Login History

                </h3>

            </div>

            <table class="min-w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-5 py-3 text-left">
                            User
                        </th>

                        <th class="px-5 py-3">
                            Login
                        </th>

                        <th class="px-5 py-3">
                            Logout
                        </th>

                        <th class="px-5 py-3">
                            Browser
                        </th>

                        <th class="px-5 py-3">
                            Platform
                        </th>

                        <th class="px-5 py-3">
                            Device
                        </th>

                        <th class="px-5 py-3">
                            IP
                        </th>

                        <th class="px-5 py-3">
                            Country
                        </th>

                        <th class="px-5 py-3">
                            City
                        </th>
                        <th class="px-5 py-3">
                            Duration
                        </th>

                        <th class="px-5 py-3">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($activities as $activity)

                        <tr class="border-b hover:bg-gray-50">

                            {{-- User --}}

                            <td class="px-5 py-4">

                                <div class="flex items-center gap-3">

                                    <div>

                                        @if($activity->user->avatar && Storage::disk('public')->exists($activity->user->avatar))

                                        <img
                                            src="{{ asset('storage/'.$activity->user->avatar) }}"
                                            class="w-10 h-10 rounded-full object-cover">

                                        @else

                                        <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">

                                            {{ strtoupper(substr($activity->user->name,0,1)) }}

                                        </div>

                                        @endif

                                    </div>

                                    <div>

                                        <div class="font-semibold">

                                            {{ $activity->user->name }}

                                        </div>

                                        <div class="text-xs text-gray-500">

                                            {{ $activity->user->email }}

                                        </div>

                                    </div>

                                </div>

                            </td>

                            {{-- Login --}}

                            <td class="px-5 py-4 text-center">

                                {{ $activity->login_at->format('d M Y') }}

                                <br>

                                <span class="text-gray-500 text-sm">

                                    {{ $activity->login_at->format('h:i A') }}

                                </span>

                            </td>

                            {{-- Logout --}}

                            <td class="px-5 py-4 text-center">

                                @if($activity->logout_at)

                                    {{ $activity->logout_at->format('d M Y') }}

                                    <br>

                                    <span class="text-gray-500 text-sm">

                                        {{ $activity->logout_at->format('h:i A') }}

                                    </span>

                                @else

                                    <span class="text-green-600 font-semibold">

                                        Active

                                    </span>

                                @endif

                            </td>

                            <td class="px-5 py-4 text-center">

                                {{ $activity->browser }}

                            </td>

                            <td class="px-5 py-4 text-center">

                                {{ $activity->platform }}

                            </td>

                            <td class="px-5 py-4 text-center">

                                {{ $activity->device }}

                            </td>

                            <td class="px-5 py-4 text-center">

                                {{ $activity->ip_address }}

                            </td>

                            <td class="px-5 py-4 text-center">

                                {{ $activity->country ?? '-' }}

                            </td>

                            <td class="px-5 py-4 text-center">

                                {{ $activity->city ?? '-' }}

                            </td>
                            <td class="px-5 py-4  text-center">

                            @if($activity->logout_at)

                            {{ $activity->login_at->diffForHumans($activity->logout_at, true) }}

                            @else

                            <span class="text-green-600 font-semibold">

                            Running

                            </span>

                            @endif

                            </td>

                            {{-- Status --}}

                            <td class="px-5 py-4 text-center">

                                @if($activity->logout_at)

                                    <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-xs">

                                        Offline

                                    </span>

                                @else

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">

                                        Online

                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="10"
                                class="text-center py-10 text-gray-500">

                                No Login Activity Found

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="p-5">

                {{ $activities->links() }}

            </div>

        </div>

    </div>

</x-app-layout>
