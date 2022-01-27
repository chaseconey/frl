<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Blog') }}
        </h2>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 pb-20 lg:pb-28">
        <div class="py-12 relative max-w-lg mx-auto lg:max-w-7xl">
            <div class="grid gap-16 lg:grid-cols-2 lg:gap-x-5 lg:gap-y-12">
                @foreach($posts as $post)
                <div class="bg-white dark:bg-gray-700 p-4 sm:rounded-md">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        <time datetime="{{ $post->publish_date->toDateString() }}">{{ $post->publish_date->format('F d Y h:i A') }}</time>
                    </p>
                    <a href="{{ route('blog.show', $post->slug) }}" class="mt-2 block">
                        <p class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                            {{ $post->title }}
                        </p>
                        <p class="mt-3 text-base text-gray-500 dark:text-gray-400">
                            {{ $post->excerpt ?? '' }}
                        </p>
                    </a>
                    <div class="mt-3">
                        <a href="{{ route('blog.show', $post->slug) }}" class="text-base font-semibold text-indigo-600 dark:text-indigo-300 hover:text-indigo-500">
                            Read full story
                        </a>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="my-4 sm:my-6 lg:my-8">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

