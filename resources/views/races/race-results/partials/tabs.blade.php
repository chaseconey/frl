@php
    $links = [
        ['link' => route('race.quali-results.index', $race->id), 'title' => 'Qualifying Results', 'activeRoute' => 'race.quali-results.*'],
        ['link' => route('race.results.index', $race->id), 'title' => 'Race Results', 'activeRoute' => 'race.results.*'],
        ['link' => route('races.protests', $race->id), 'title' => 'Protests', 'activeRoute' => 'races.protests']
    ];

    if ($race->broadcastVideos()->exists()) {
        $links[] = ['link' => route('races.broadcast', $race->id), 'title' => 'Broadcast', 'activeRoute' => 'races.broadcast'];
    }

    if (auth()->user()->hasRole('admin')) {
        $links[] = ['link' => "/nova/resources/races/{$race->id}", 'title' => 'Manage Race', 'activeRoute' => ''];
    }

@endphp

@include('components.tabs', [
    'links' => $links
])
