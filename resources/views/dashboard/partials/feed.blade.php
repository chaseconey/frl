<div class="bg-white dark:bg-gray-700 shadow overflow-hidden sm:rounded-md">
    <div class="py-5 px-4 border-b border-gray-200 dark:border-gray-800">
        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
            Feed
        </h3>
    </div>
    <ul class="divide-y divide-gray-200 dark:divide-gray-800">
        @forelse($feed as $event)
            <li class="py-4 px-4 sm:px-6">
                <div class="flex space-x-3">
                    <x-user-avatar :user="$event->causer" />
                    <div class="flex-1 space-y-1">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-medium dark:text-gray-100">{{ $event->causer->name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-200">{{ $event->created_at->diffForHumans() }}</p>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-200">{{ $event->description }}</p>
                    </div>
                </div>
            </li>
        @empty

            <li class="py-4 px-4 sm:px-6 dark:text-gray-100">
                No recent events
            </li>

        @endforelse
    </ul>
</div>
