<div>
    <div class="sm:hidden">
        <label for="tabs" class="sr-only">Select a tab</label>
        <select id="tabs" name="tabs" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
            @foreach ($links as $link)
            <option>{{ $link['title'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="hidden sm:block">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                @foreach ($links as $link)
                <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
                <a href="{{ $link['link'] }}" class="{{ Request::routeIs($link['activeRoute']) ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" aria-current="page">
                    {{ $link['title'] }}
                </a>
                @endforeach
            </nav>
        </div>
    </div>
</div>