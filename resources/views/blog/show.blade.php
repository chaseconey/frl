<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto">
        <div
            class="grid grid-cols-1 gap-4 text-gray-800 dark:text-gray-100 bg-white dark:bg-gray-700 shadow sm:rounded-md p-4 md:p-12">
            <article class="prose lg:prose-xl dark:prose-invert">
                @if($post->featured_image)
                    <img src="{{ $post->featured_image }}">
                @endif
                <div> {!! $content !!} </div>
            </article>
        </div>
    </div>
</x-app-layout>

