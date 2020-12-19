<div class="mt-4">
    <h2 class="text-gray-500 text-xs font-medium uppercase tracking-wide">Available Divisions</h2>
    <ul class="mt-3 grid grid-cols-1 gap-5 sm:gap-6 sm:grid-cols-2">


        @foreach($divisions as $division)
            <li class="col-span-1 flex shadow-sm rounded-md">
                <div
                    class="flex-shrink-0 flex items-center justify-center w-16 bg-green-600 text-white text-sm font-medium rounded-l-md">
                    {{ $division->id }}
                </div>
                <div
                    class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                    <div class="flex-1 px-4 py-2 text-sm truncate">
                        <a href="{{ route('signup.create', ['division_id' => $division->id]) }}"
                           class="text-gray-900 font-medium hover:text-gray-600">{{ $division->name }}</a>
                        <p class="text-gray-500">{{ $division->drivers_count }} {{ Str::plural('Members', $division->drivers_count) }}</p>
                    </div>
                    <div class="flex-shrink-0 pr-2">
                        <button
                            class="w-8 h-8 bg-white inline-flex items-center justify-center text-gray-400 rounded-full bg-transparent hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                 fill="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </li>
        @endforeach

    </ul>
</div>
