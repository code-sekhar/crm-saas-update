<aside
    :class="sidebarOpen ? 'w-64' : 'w-20'"
    class="bg-slate-900 text-white min-h-screen flex flex-col transition-all duration-300">

    <!-- Logo -->
    <div class="px-6 py-3 border-b border-slate-700">

        <div x-show="sidebarOpen">


            <h1 class="text-2xl font-bold">
                CRM SaaS
            </h1>

            <p class="text-xs text-slate-400 mt-1">
                Sales Management
            </p>

        </div>

        <div
            x-show="!sidebarOpen"
            x-transition
            class="flex justify-center">

            <i class="fa-solid fa-chart-line text-3xl text-blue-500"></i>

        </div>

    </div>

    <!-- Menu -->
    <nav class="flex-1 px-3 py-5 space-y-2">

        <a href="{{ route('dashboard') }}"
            class="flex items-center px-4 py-3 rounded-lg transition
            {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}"
            :class="sidebarOpen ? 'gap-3 justify-start' : 'justify-center'">

                <i class="fa-solid fa-chart-line w-5 text-center"></i>

                <span x-show="sidebarOpen" x-transition>
                    Dashboard
                </span>

        </a>

        <a href="{{ route('leads.index') }}"
            class="flex items-center px-4 py-3 rounded-lg transition
            {{ request()->routeIs('leads.*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}"
            :class="sidebarOpen ? 'gap-3 justify-start' : 'justify-center'">

                <i class="fa-solid fa-users w-5"></i>

                <span x-show="sidebarOpen" x-transition>
                    Leads
                </span>

            </a>

        <a href="{{ route('tasks.index') }}"
           class="flex items-center px-4 py-3 rounded-lg transition
           {{ request()->routeIs('tasks.*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}"
            :class="sidebarOpen ? 'gap-3 justify-start' : 'justify-center'">

            <i class="fa-solid fa-list-check w-5"></i>


             <span x-show="sidebarOpen">Tasks</span>

        </a>

        <a href="{{ route('follow-ups.index') }}"
           class="flex items-center px-4 py-3 rounded-lg transition
           {{ request()->routeIs('follow-ups.*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}"
            :class="sidebarOpen ? 'gap-3 justify-start' : 'justify-center'">

            <i class="fa-solid fa-phone-volume w-5"></i>


            <span x-show="sidebarOpen">Follow Ups</span>

        </a>

        <a href="{{ route('calendar.index') }}"
           class="flex items-center px-4 py-3 rounded-lg transition
           {{ request()->routeIs('calendar.*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}"
            :class="sidebarOpen ? 'gap-3 justify-start' : 'justify-center'">

            <i class="fa-solid fa-calendar-days w-5"></i>


            <span x-show="sidebarOpen">Calendar</span>

        </a>

        <a href="{{ route('kanban.index') }}"
           class="flex items-center px-4 py-3 rounded-lg transition
           {{ request()->routeIs('kanban.*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}"
            :class="sidebarOpen ? 'gap-3 justify-start' : 'justify-center'">

            <i class="fa-solid fa-table-columns w-5"></i>


            <span x-show="sidebarOpen">Kanban</span>

        </a>

        <a href="{{ route('reports.index') }}"
            class="flex items-center px-4 py-3 rounded-lg transition {{ request()->routeIs('reports.*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}"
            :class="sidebarOpen ? 'gap-3 justify-start' : 'justify-center'">

            <i class="fa-solid fa-chart-pie w-5"></i>


            <span x-show="sidebarOpen">Reports</span>

            <span
                x-show="sidebarOpen"
                class="ml-auto text-xs bg-yellow-500 text-black px-2 py-1 rounded">

                Soon

            </span>

        </a>
        <a href="{{ route('settings.company') }}"
           class="flex items-center px-4 py-3 rounded-lg transition
           {{ request()->routeIs('settings.*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}"
            :class="sidebarOpen ? 'gap-3 justify-start' : 'justify-center'">

            <i class="fa-solid fa-table-columns w-5"></i>


            <span x-show="sidebarOpen">Company Settings</span>

        </a>





    </nav>

    <!-- User -->

    <div class="border-t border-slate-700 p-4">

        <div
            class="flex items-center"
            :class="sidebarOpen ? 'gap-3' : 'justify-center'">

            <div
                class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center font-bold">

                {{ strtoupper(substr(auth()->user()->name,0,1)) }}

            </div>

            <div
                x-show="sidebarOpen"
                x-transition>

                <div class="font-semibold">

                    {{ auth()->user()->name }}

                </div>

                <div class="text-xs text-slate-400">

                    {{ auth()->user()->email }}

                </div>

            </div>

        </div>

        <form
            method="POST"
            action="{{ route('logout') }}"
            class="mt-5">

            @csrf

            <button
                class="w-full bg-red-600 hover:bg-red-700 py-2 rounded-lg flex items-center justify-center gap-2">

                <i class="fa-solid fa-right-from-bracket"></i>

                <span x-show="sidebarOpen">
                    Logout
                </span>

            </button>

        </form>

    </div>

</aside>
