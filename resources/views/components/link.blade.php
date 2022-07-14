
@props([
    'href',
    'primary' => true,
])

<a href="{{ $href }}" @class([
        'text-indigo-600 dark:text-indigo-400 hover:text-indigo-900' => $primary,
        'text-gray-600 dark:text-gray-400 hover:text-gray-900' => !$primary
    ])>
    {{ $slot }}
</a>
