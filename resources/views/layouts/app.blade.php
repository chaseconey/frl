<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        @vite('resources/css/app.css')

        @production
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-W2DQ2BPDFL"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'G-W2DQ2BPDFL');
        </script>
        @endproduction

    </head>
    <body class="font-sans antialiased">
        <div class="flex flex-col min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white dark:bg-gray-700 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            @include('layouts.partials.steward-warning')

            <!-- Page Content -->
            <main class="flex-grow mb-4">
                {{ $slot }}
            </main>

            @include('layouts.partials.footer')
        </div>
    </body>
    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/399fc73196.js" crossorigin="anonymous"></script>

    @vite('resources/js/app.js')

    {{ $scripts ?? '' }}
</html>
