<x-guest-layout>
    <div class="relative bg-white dark:bg-gray-700 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div x-data="{ open: false }"
                 class="relative z-10 pb-8 bg-white dark:bg-gray-700 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white dark:text-gray-900 transform translate-x-1/2"
                     fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                    <polygon points="50,0 100,0 50,100 0,100"/>
                </svg>

                <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
                    <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start"
                         aria-label="Global">
                        <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
                            <div class="flex items-center justify-between w-full md:w-auto">
                                <a href="/">
                                    <x-application-logo class="w-20 h-20 fill-current text-gray-500 dark:text-gray-200"/>
                                </a>
                                <div class="-mr-2 flex items-center md:hidden">
                                    <button type="button"
                                            @click="open = ! open"
                                            class="bg-white dark:bg-gray-700 rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                                            id="main-menu" aria-haspopup="true">
                                        <span class="sr-only">Open main menu</span>
                                        <!-- Heroicon name: menu -->
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M4 6h16M4 12h16M4 18h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="hidden md:block md:ml-10 md:pr-4 md:space-x-8">
                            <a href="#league" class="font-medium text-gray-500 dark:text-gray-200 hover:text-gray-900 dark:hover:text-gray-100">League Benefits</a>
                            <a href="https://discord.gg/73u3p54" target="_blank"
                               class="font-medium text-gray-500 dark:text-gray-200 hover:text-gray-900 dark:hover:text-gray-100">Discord</a>
                            <a href="{{ route('standings.index') }}"
                               class="font-medium text-gray-500 dark:text-gray-200 hover:text-gray-900 dark:hover:text-gray-100">Standings</a>

                            @auth
                                <a href="{{ route('dashboard') }}"
                                   class="font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}"
                                   class="font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500">Log in</a>
                            @endauth

                        </div>
                    </nav>
                </div>

                <!--
                  Mobile menu, show/hide based on menu open state.

                  Entering: "duration-150 ease-out"
                    From: "opacity-0 scale-95"
                    To: "opacity-100 scale-100"
                  Leaving: "duration-100 ease-in"
                    From: "opacity-100 scale-100"
                    To: "opacity-0 scale-95"
                -->
                <div :class="{'block': open, 'hidden': ! open}"
                     class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden">
                    <div class="rounded-lg shadow-md bg-white dark:bg-gray-700 ring-1 ring-black ring-opacity-5 overflow-hidden">
                        <div class="px-5 pt-4 flex items-center justify-between">
                            <div class="-mr-2">
                                <button type="button"
                                        @click="open = false"
                                        class="bg-white dark:bg-gray-700 rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                    <span class="sr-only">Close main menu</span>
                                    <!-- Heroicon name: x -->
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div role="menu" aria-orientation="vertical" aria-labelledby="main-menu">
                            <div class="px-2 pt-2 pb-3 space-y-1" role="none">
                                <a href="#league"
                                   class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-gray-100 hover:bg-gray-50 dark:hover:bg-gray-800"
                                   role="menuitem">League Benefits</a>

                                <a href="https://discord.gg/73u3p54"
                                   class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-gray-100 hover:bg-gray-50 dark:hover:bg-gray-800"
                                   role="menuitem">Discord</a>

                                <a href="{{ route('standings.index') }}"
                                   class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-gray-100 hover:bg-gray-50 dark:hover:bg-gray-800"
                                   role="menuitem">Standings</a>
                            </div>
                            @auth
                                <div role="none">
                                    <a href="{{ route('dashboard') }}"
                                       class="block w-full px-5 py-3 text-center font-medium text-indigo-600 dark:text-indigo-400 bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-800"
                                       role="menuitem">
                                        Dashboard
                                    </a>
                                </div>
                            @else
                                <div role="none">
                                    <a href="{{ route('login') }}"
                                       class="block w-full px-5 py-3 text-center font-medium text-indigo-600 dark:text-indigo-400 bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-800"
                                       role="menuitem">
                                        Log in
                                    </a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>

                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Formula Racing League</span>
                            <span class="block text-indigo-600 dark:text-indigo-400 xl:inline">F1 2020</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 dark:text-gray-200 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            A multi-division racing league for the Formula 1 game F1 2020.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="{{ route('register') }}"
                                   class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white dark:text-gray-900 bg-indigo-600 dark:bg-indigo-400 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                                    Get started
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="https://discord.gg/73u3p54"
                                   target="_blank"
                                   class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 md:py-4 md:text-lg md:px-10">
                                    Discord
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="/img/2020banner.jpg" alt="">
        </div>
    </div>

    <div class="bg-white dark:bg-gray-700" id="league">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-24 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">League Benefits</h2>
                <p class="mt-4 text-lg text-gray-500 dark:text-gray-200">FRL offers a plethora of benefits above and beyond clean, quality races.</p>
            </div>
            <dl class="mt-12 space-y-10 sm:space-y-0 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:gap-y-12 lg:grid-cols-3 lg:gap-x-8">

                @php
                $features = [
                    ['title' => 'Broadcasts', 'desc' => 'We have broadcasts (both live and recorded) for every race in all divisions.'],
                    ['title' => 'League Portal', 'desc' => 'We have a rich league portal experience that keeps track of all race data, rosters and team management, and standings.'],
                    ['title' => 'Championship Tracking', 'desc' => 'All races have point values for both individuals and Constructors.'],
                    ['title' => 'Discord Community', 'desc' => 'We have an extremely active and engaged community in Discord.'],
                    ['title' => 'Stewarding System', 'desc' => 'While we expect clean races, racing incident do happen. FRL has a comprehensive stewarding process to ensure fair results.'],
                    ['title' => 'Telemetry Data', 'desc' => 'We may have a few data nerds among us - which means lots of great race analysis!'],
                ];
                @endphp

                @foreach($features as $feature)
                    <div class="flex">
                        <!-- Heroicon name: check -->
                        <svg class="flex-shrink-0 h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <div class="ml-3">
                            <dt class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                                {{ $feature['title'] }}
                            </dt>
                            <dd class="mt-2 text-base text-gray-500 dark:text-gray-200">
                                {{ $feature['desc'] }}
                            </dd>
                        </div>
                    </div>
                @endforeach
            </dl>
        </div>
    </div>

    <div id="broadcast-center py-16">
        <!-- Add a placeholder for the Twitch embed -->
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">Broadcast Center</h2>
        </div>
        <div id="twitch-embed" class="flex justify-center my-4"></div>

        <!-- Load the Twitch embed script -->
        <script src="https://embed.twitch.tv/embed/v1.js"></script>

        <!-- Create a Twitch.Embed object that will render within the "twitch-embed" root element. -->
        <script type="text/javascript">
            new Twitch.Embed("twitch-embed", {
                width: 854,
                height: 480,
                channel: "FormulaRacingLeague_",
            });
        </script>
    </div>

    <footer class="bg-white dark:bg-gray-700">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 flex justify-center lg:px-8">
            <div class="mt-8 md:mt-0 md:order-1">
                <p class="text-center text-base text-gray-400">
                    &copy; {{ now()->year }} Formula Racing League. All rights reserved.
                </p>
            </div>
        </div>
    </footer>


</x-guest-layout>
