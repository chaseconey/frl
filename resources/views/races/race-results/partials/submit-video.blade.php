<div x-data="{ openMenu: false, openPopover: false }">

    <div class="relative inline-block text-left">
        <div>
            <button type="button"
                    class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" id="options-menu" aria-haspopup="true" aria-expanded="true"
                    @click="openMenu = true"
            >
                Options
                <!-- Heroicon name: chevron-down -->
                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
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
        <div style="display:none;"
             x-show="openMenu"
             @click.away="openMenu = false"
             class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5"
        >
            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                <span @click="openPopover = true" class="block px-4 py-2 cursor-pointer text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Submit Perspective</span>
                <a href="{{ route('protests.create', ['division_id' => $race->division_id, 'race_id' => $race->id]) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Protest Race</a>
            </div>
        </div>
    </div>
    <div x-show="openPopover"
         @click.away="openPopover = false"
         style="display:none;"
         class="absolute top-0 right-4 text-left"
    >
        <div class="bg-white shadow sm:rounded-lg w-full">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Submit Driver Perspective
                </h3>
                <div class="mt-2 max-w-xl text-sm text-gray-500">
                    <p>
                        Upload a video of your perspective of this race.
                    </p>
                </div>
                <form class="mt-5 sm:flex sm:items-center" method="POST" action="{{ route('driver-videos.store') }}">
                    @csrf
                    <input type="hidden" name="race_id" value="{{ $race->id }}">
                    <div class="max-w-xs w-full">
                        <label for="video_url" class="sr-only">Video URL</label>
                        <input type="text" name="video_url" id="video_url" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="https://youtube.com/watch?abcdef">
                    </div>
                    <button type="submit" class="mt-3 w-full inline-flex items-center justify-center px-4 py-2 border border-transparent shadow-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
