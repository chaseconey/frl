<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Race Broadcast') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

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
                                    <span class="text-xs text-gray-500">{{ $info->publishedTime }}</span>
                                </h3>
                                {!! $info->code !!}
                            </div>


                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
