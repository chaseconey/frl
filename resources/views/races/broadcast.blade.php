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

                    @include('races.race-results.partials.breadcrumbs', ['race' => $race])

                    <div class="my-4">
                        @include('races.race-results.partials.tabs')
                    </div>

                    <div class="my-4 flex justify-center">
                        <div id="ytplayer"></div>

                        <script>
                            // Load the IFrame Player API code asynchronously.
                            var tag = document.createElement('script');
                            tag.src = "https://www.youtube.com/player_api";
                            var firstScriptTag = document.getElementsByTagName('script')[0];
                            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

                            // Replace the 'ytplayer' element with an <iframe> and
                            // YouTube player after the API code downloads.
                            var player;
                            function onYouTubePlayerAPIReady() {
                                player = new YT.Player('ytplayer', {
                                    height: '360',
                                    width: '640',
                                    videoId: '{{ $race->broadcast_id }}'
                                });
                            }
                        </script>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
