<x-app-layout>

   <x-slot name="header">

        <div>

            <h2 class="text-2xl font-bold text-gray-800">

                Company Settings

            </h2>

            <p class="text-gray-500 mt-1">

                Manage your organization information and branding.

            </p>

        </div>

    </x-slot>

    <div class="max-w-5xl mx-auto">

        @if(session('success'))
            <div class="mb-5 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">

            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-5">

                <h2 class="text-white text-xl font-semibold">

                    Company Information

                </h2>

                <p class="text-blue-100 text-sm mt-1">

                    Configure your company details and branding.

                </p>

            </div>

            <div class="p-8">

            <form
                method="POST"
                action="{{ route('settings.company.store') }}"
                enctype="multipart/form-data">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Company Name -->
                    <div>

                        <label class="block font-semibold mb-2">
                            Company Name
                        </label>

                        <input
                            type="text"
                            name="company_name"
                            value="{{ old('company_name',$setting->company_name) }}"
                            class="w-full rounded-lg border-gray-300">

                        @error('company_name')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- Email -->
                    <div>

                        <label class="block font-semibold mb-2">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email',$setting->email) }}"
                            class="w-full rounded-lg border-gray-300">

                    </div>

                    <!-- Phone -->
                    <div>

                        <label class="block font-semibold mb-2">
                            Phone
                        </label>

                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone',$setting->phone) }}"
                            class="w-full rounded-lg border-gray-300">

                    </div>

                    <!-- Website -->
                    <div>

                        <label class="block font-semibold mb-2">
                            Website
                        </label>

                        <input
                            type="text"
                            name="website"
                            value="{{ old('website',$setting->website) }}"
                            class="w-full rounded-lg border-gray-300">

                    </div>

                    <!-- GST -->
                    <div>

                        <label class="block font-semibold mb-2">
                            GST Number
                        </label>

                        <input
                            type="text"
                            name="gst_number"
                            value="{{ old('gst_number',$setting->gst_number) }}"
                            class="w-full rounded-lg border-gray-300">

                    </div>

                    <!-- Currency -->
                    <div>

                        <label class="block font-semibold mb-2">
                            Currency
                        </label>

                        <select
                            name="currency"
                            class="w-full rounded-lg border-gray-300">

                            <option
                                value="INR"
                                @selected($setting->currency=='INR')>

                                INR

                            </option>

                            <option
                                value="USD"
                                @selected($setting->currency=='USD')>

                                USD

                            </option>

                            <option
                                value="EUR"
                                @selected($setting->currency=='EUR')>

                                EUR

                            </option>

                        </select>

                    </div>

                    <!-- Timezone -->
                    <div>

                        <label class="block font-semibold mb-2">
                            Timezone
                        </label>

                        <select
                            name="timezone"
                            class="w-full rounded-lg border-gray-300">

                            <option
                                value="Asia/Kolkata"
                                @selected($setting->timezone=='Asia/Kolkata')>

                                Asia/Kolkata

                            </option>

                            <option
                                value="UTC"
                                @selected($setting->timezone=='UTC')>

                                UTC

                            </option>

                        </select>

                    </div>

                    <!-- Logo -->
                    {{-- <div>

                        <label class="block font-semibold mb-2">
                            Company Logo
                        </label>

                        <input
                            type="file"
                            name="logo"
                            class="w-full">

                        @if($setting->logo)

                            <img
                                src="{{ asset('storage/'.$setting->logo) }}"
                                class="mt-4 w-28 h-28 object-contain border rounded-lg">

                        @endif

                    </div> --}}
                    <!-- Company Logo -->

                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-3">

                        Company Logo

                    </label>

                    <div
                        class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-blue-500 transition">

                        @if($setting->logo)

                            <img
                                id="logoPreview"
                                src="{{ asset('storage/'.$setting->logo) }}"
                                class="mx-auto h-32 object-contain rounded-lg">

                        @else

                            <img
                                id="logoPreview"
                                src="https://placehold.co/250x150?text=Company+Logo"
                                class="mx-auto h-32 object-contain rounded-lg">

                        @endif

                        <input
                            id="logoInput"
                            type="file"
                            name="logo"
                            accept="image/*"
                            class="hidden">

                        <button
                            type="button"
                            onclick="document.getElementById('logoInput').click()"
                            class="mt-5 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                            <i class="fa-solid fa-upload mr-2"></i>

                            Choose Logo

                        </button>

                        <p class="text-xs text-gray-500 mt-3">

                            PNG, JPG, JPEG, WEBP (Max: 2MB)

                        </p>

                    </div>

                </div>

                </div>

                <!-- Address -->

                <div class="mt-6">

                    <label class="block font-semibold mb-2">

                        Address

                    </label>

                    <textarea
                        rows="4"
                        name="address"
                        class="w-full rounded-lg border-gray-300">{{ old('address',$setting->address) }}</textarea>

                </div>

                <!-- Save Button -->

                <div class="mt-8">

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg">

                        Save Company Settings

                    </button>

                </div>

            </form>

        </div>

    </div>
<script>

document
.getElementById('logoInput')
.addEventListener('change', function(e){

    const file = e.target.files[0];

    if(file){

        document
        .getElementById('logoPreview')
        .src = URL.createObjectURL(file);

    }

});

</script>
</x-app-layout>
