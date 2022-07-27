<nav x-data="{ open: false }" class="bg-white dark:bg-gray-700 border-b border-gray-100 dark:border-gray-900">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-16 w-16 fill-current text-gray-600 dark:text-gray-300" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('signup.index')" :active="request()->routeIs('signup.*')">
                        {{ __('Signup') }}
                    </x-nav-link>
                    <x-nav-link :href="route('divisions.index')" :active="request()->routeIs('divisions.*')">
                        {{ __('Roster') }}
                    </x-nav-link>

                    <x-dropdown align="left" containerClasses="self-center pt-0.5">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 dark:text-gray-200 hover:text-gray-700 dark:hover:text-gray-200 hover:border-gray-300 dark:hover:border-gray-600 focus:outline-none focus:text-gray-700 dark:focus:text-gray-200 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>Races</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="divide-y divide-gray-100 dark:divide-gray-900">
                                <x-dropdown-link :href="route('races.index')">
                                    {{ __('Calendar') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('races.list')">
                                    {{ __('List') }}
                                </x-dropdown-link>

                                @can('manage-races')
                                <x-dropdown-link :href="route('calendar-creator.index')">
                                    {{ __('Race Wizard') }}
                                </x-dropdown-link>
                                @endcan
                            </div>
                        </x-slot>
                    </x-dropdown>

                    <x-nav-link :href="route('standings.index')" :active="request()->routeIs('standings.*')">
                        {{ __('Standings') }}
                    </x-nav-link>

                    <x-nav-link :href="route('blog.index')" :active="request()->routeIs('blog.*')">
                        {{ __('Blog') }}
                    </x-nav-link>

                    @can('view-admin')
                    <x-nav-link href="/nova">
                        {{ __('Admin') }}
                    </x-nav-link>
                    @endcan
                </div>
            </div>

            <div class="flex-1 flex items-center justify-center px-2 lg:ml-6 lg:justify-end">
                <div class="max-w-lg w-full lg:max-w-xs">
                    <form action="{{ route('races.list') }}">
                        <label for="search" class="sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <!-- Heroicon name: solid/search -->
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input id="search" name="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Search" type="search">
                        </div>
                    </form>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                <!-- Settings Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 dark:text-gray-200 hover:text-gray-700 dark:hover:text-gray-200 hover:border-gray-300 dark:hover:border-gray-600 focus:outline-none focus:text-gray-700 dark:focus:text-gray-200 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="divide-y divide-gray-100 dark:divide-gray-900">
                            <div class="px-4 py-3">
                                <p class="text-sm dark:text-gray-100">
                                    Signed in as
                                </p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                    {{ auth()->user()->email }}
                                </p>
                            </div>
                            <div>
                                @foreach(auth()->user()->activeDrivers as $driver)
                                    <x-dropdown-link :href="route('drivers.show', $driver->id)">
                                        {{ $driver->name }}
                                        <span class="text-gray-600 dark:text-gray-300 text-xs">{{ $driver->division->name }}</span>
                                    </x-dropdown-link>
                                @endforeach
                            </div>
                            <div>
                                <x-dropdown-link :href="route('profile.protests')">
                                    {{ __('My Protests') }}
                                </x-dropdown-link>
                            </div>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Logout') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
                @endauth

                @guest
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                            {{ __('Login') }}
                        </x-nav-link>
                    </div>
                @endguest
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('signup.index')" :active="request()->routeIs('signup.*')">
                {{ __('Sign Up') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('divisions.index')" :active="request()->routeIs('divisions.*')">
                {{ __('Roster') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('races.list')" :active="!request()->routeIs('races.index') && request()->routeIs('races*')">
                {{ __('Races') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('races.index')" :active="request()->routeIs('races.index')">
                {{ __('Race Calendar') }}
            </x-responsive-nav-link>
            @can('manage-races')
            <x-responsive-nav-link :href="route('calendar-creator.index')" :active="request()->routeIs('calendar-creator.index')">
                {{ __('Race Wizard') }}
            </x-responsive-nav-link>
            @endcan
            <x-responsive-nav-link :href="route('standings.index')" :active="request()->routeIs('standings.*')">
                {{ __('Standings') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('blog.index')" :active="request()->routeIs('blog.*')">
                {{ __('Blog') }}
            </x-responsive-nav-link>

            @can('view-admin')
            <x-responsive-nav-link href="/nova">
                {{ __('Admin') }}
            </x-responsive-nav-link>
            @endcan
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-800">
            @auth
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-100">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500 dark:text-gray-200">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                @foreach(auth()->user()->activeDrivers as $driver)
                    <x-responsive-nav-link :href="route('drivers.show', $driver->id)">
                        {{ $driver->name }}
                        <span class="text-gray-600 dark:text-gray-300 text-xs">{{ $driver->division->name }}</span>
                    </x-responsive-nav-link>
                @endforeach

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-responsive-nav-link>
                </form>
            </div>
            @endauth
            @guest
                <x-responsive-nav-link :href="route('login')">
                    Login
                </x-responsive-nav-link>
            @endguest
        </div>
    </div>
</nav>
