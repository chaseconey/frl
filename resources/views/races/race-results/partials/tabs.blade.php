@php
    $links = [
        ['link' => route('race.quali-results.index', $race->id), 'title' => 'Qualifying Results', 'activeRoute' => 'race.quali-results.*'],
        ['link' => route('race.results.index', $race->id), 'title' => 'Race Results', 'activeRoute' => 'race.results.*']
    ];

    if ($race->broadcast_id) {
        $links[] = ['link' => route('races.broadcast', $race->id), 'title' => 'Broadcast', 'activeRoute' => 'races.broadcast'];
    }

@endphp

@include('components.tabs', [
    'links' => $links
])
