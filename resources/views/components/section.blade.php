
@props([
    'title'
])

<div {{ $attributes->merge(['class' => 'bg-white dark:bg-gray-700 shadow overflow-hidden sm:rounded-md']) }}>

    <div class="bg-white dark:bg-gray-700 px-4 py-5 border-b border-gray-200 dark:border-gray-800 sm:px-6">
        <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-nowrap">
            <div class="ml-4 mt-2">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">
                    {{ $title }}
                </h3>
            </div>
{{--                    <div class="ml-4 mt-2 flex-shrink-0">--}}
{{--                        <button type="button" class="relative inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">--}}
{{--                            Create new job--}}
{{--                        </button>--}}
{{--                    </div>--}}
        </div>
    </div>

    {{ $slot }}
</div>
