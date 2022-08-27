
@props([
    'track',
    'size' => 10
])

@if($track->avatar)
    <img {{ $attributes->class("h-{$size} w-{$size} rounded-full") }}
         src="/storage/{{ $track->avatar }}"
         alt="{{ $track->name }}">
@else
    <img {{ $attributes->class("h-{$size} w-{$size} rounded-full") }}
         src="https://via.placeholder.com/150"
         alt="{{ $track->name }}">
@endif
