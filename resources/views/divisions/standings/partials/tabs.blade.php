@php

$links = [];

foreach ($divisions as $division) {
    $link = [];
    $link['link'] = route('standings.index', ['division_id' => $division->id]);
    $link['title'] = $division->name;;
    $link['activeRoute'] = '*';

    $links[] = $link;
}

@endphp


@include('components.tabs', [
    'links' => $links
])
