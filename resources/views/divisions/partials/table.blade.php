<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Driver
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Type
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Races
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($drivers as $driver)
                        <tr class="{{ auth()->user()->hasDriver($driver->id) ? 'bg-gray-100' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap truncate">
                                <div class="ml-4 border-l-4 pl-2 {{ f1_team_color($driver->f1Team->name) }}">
                                    <div class="text-sm font-medium text-gray-900 truncate">
                                        {{ $driver->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $driver->f1Team->name }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $driver->type }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $driver->raceResults()->count() }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap" x-data="{ open: false }">
                                <div class="relative inline-block text-left">
                                    <div class="z-0">
                                        <button @click="open = true"
                                                class="rounded-full flex items-center text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
                                                id="options-menu" aria-haspopup="true" aria-expanded="true">
                                            <span class="sr-only">Open options</span>
                                            <!-- Heroicon name: dots-vertical -->
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                            </svg>
                                        </button>
                                    </div>

                                    <!--
                                      Dropdown panel, show/hide based on dropdown state.

                                      Entering: "transition ease-out duration-100"
                                        From: "transform opacity-0 scale-95"
                                        To: "transform opacity-100 scale-100"
                                      Leaving: "transition ease-in duration-75"
                                        From: "transform opacity-100 scale-100"
                                        To: "transform opacity-0 scale-95"
                                    -->
                                    <div x-show="open"
                                         @click.away="open = false"
                                         style="display: none;"
                                         class="z-50 origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                                        <div class="py-1 z-10" role="menu" aria-orientation="vertical"
                                             aria-labelledby="options-menu">
                                            @if(auth()->user()->hasDriver($driver->id))
                                                <form method="POST" action="{{ route('drivers.update', $driver) }}">
                                                    @method('PUT')
                                                    @csrf
                                                    <button type="submit"
                                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
                                                            role="menuitem">
                                                        Unclaim Driver
                                                    </button>
                                                </form>
                                            @elseif(is_null($driver->user_id))
                                                <form method="POST" action="{{ route('drivers.update', $driver) }}">
                                                    @method('PUT')
                                                    @csrf
                                                    <button type="submit"
                                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
                                                            role="menuitem">
                                                        Claim Driver
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="#"
                                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                               role="menuitem">Driver Profile</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
