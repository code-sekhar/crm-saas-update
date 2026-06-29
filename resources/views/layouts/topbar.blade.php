<header class="bg-white shadow-sm border-b">

    <div class="flex items-center justify-between px-6 py-4">

        <!-- Left -->
        <div class="flex items-center gap-4">

            <!-- Sidebar Toggle -->
            <button
                @click="sidebarOpen = !sidebarOpen"
                class="text-2xl text-gray-600 hover:text-blue-600 transition">

                <i class="fa-solid fa-bars"></i>

            </button>

            <h2 class="text-2xl font-bold text-gray-800">

                CRM Dashboard

            </h2>

        </div>

        <!-- Center Search -->
        <div class="hidden md:block w-96">

            <div class="relative">

                <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400"></i>

                <input
                    type="text"
                    placeholder="Search..."
                    class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none">

            </div>

        </div>

        <!-- Right -->
        <div class="flex items-center gap-5">

            <!-- Notification -->

            <button class="relative text-gray-600 hover:text-blue-600">

                <i class="fa-solid fa-bell text-xl"></i>

                <span
                    class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] rounded-full px-1.5">

                    3

                </span>

            </button>

            <!-- User -->

            <div class="flex items-center gap-3">

                <div
                    class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">

                    {{ strtoupper(substr(auth()->user()->name,0,1)) }}

                </div>

                <div class="hidden md:block">

                    <div class="font-semibold text-gray-700">

                        {{ auth()->user()->name }}

                    </div>

                    <div class="text-xs text-gray-500">

                        {{ auth()->user()->email }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</header>
