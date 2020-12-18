@include('components.tabs', [
    'links' => [
        ['link' => route('race.quali-results.index', $race->id), 'title' => 'Qualifying Results', 'activeRoute' => 'race.quali-results.*'],
        ['link' => route('race.results.index', $race->id), 'title' => 'Race Results', 'activeRoute' => 'race.results.*']
    ]
])
