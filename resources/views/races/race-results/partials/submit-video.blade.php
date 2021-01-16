<div>
    <button type="button"
            class="inline-flex items-center px-1.5 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            @click="open = true"
    >
        Submit Perspective
    </button>
    <div x-show="open"
         @click.away="open = false"
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
