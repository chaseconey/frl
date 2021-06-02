<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ $race->track->name }} Broadcast
        </h2>
        <span class="text-gray-600 dark:text-gray-300 text-sm">{{ $race->division->name }}</span>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-700 border-b border-gray-200 dark:border-gray-800">

                    <div class="mb-4">
                        @include('components.form-errors', ['errors' => $errors])
                    </div>

                    <div class="flex flex-wrap justify-between" x-data="{ open: false }">
                        <div class="w-full sm:w-1/2">
                            @include('races.race-results.partials.breadcrumbs', ['race' => $race])
                        </div>
                        <div class="relative w-full sm:w-1/2 text-right hidden sm:block">
                            @include('races.race-results.partials.submit-video', ['race' => $race])
                        </div>
                    </div>

                    <div class="my-4">
                        @include('races.race-results.partials.tabs')
                    </div>

                    <div class="my-4 grid grid-cols-1 sm:grid-cols-3 text-center">
                        @foreach($race->broadcastVideos as $video)
                            @php
                                $info = Embed\Embed::create($video->video_url)
                            @endphp

                            <div class="text-center mx-auto">
                                <h3 class="flex flex-col my-4">
                                    <span class="font-semibold text-lg">{{ $video->title }}</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-200">{{ $info->publishedTime }}</span>
                                </h3>
                                @if(!is_null($info->code))
                                    {!! $info->code !!}
                                @else
                                    <a href="{{ $video->video_url }}"><img src="{{ $info->image }}" alt="{{ $video->title }}"></a>
                                @endif

                            </div>


                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
