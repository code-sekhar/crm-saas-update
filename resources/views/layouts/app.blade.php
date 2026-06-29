<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
          <body class="font-sans antialiased">

            <div x-data="{ sidebarOpen: true }" class="flex min-h-screen bg-gray-100">

                @include('layouts.sidebar')

                <div class="flex-1 flex flex-col">

                    @include('layouts.topbar')

                    @isset($header)

                        <header class="bg-white shadow">

                            <div class="px-6 py-5">

                                {{ $header }}

                            </div>

                        </header>

                    @endisset

                    <main class="flex-1 p-6">

                        {{ $slot }}

                    </main>

                </div>

            </div>
        </div>

        @if(session('success'))

            <script>

            Swal.fire({

                toast: true,

                position: 'top-end',

                icon: 'success',

                title: '{{ session("success") }}',

                showConfirmButton: false,

                timer: 2500

            });

            </script>

        @endif

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    </body>
</html>
