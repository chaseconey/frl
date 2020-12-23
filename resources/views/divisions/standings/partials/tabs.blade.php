
@include('components.tabs', [
    'links' => [
        ['title' => 'Race Matrix', 'link' => route('standings.matrix', ['division' => $division]), 'activeRoute' => 'standings.matrix'],
        ['title' => 'Championship Points', 'link' => route('standings.standings', ['division' => $division]), 'activeRoute' => 'standings.standings'],
        ['title' => 'Constructor Points', 'link' => route('standings.team-standings', ['division' => $division]), 'activeRoute' => 'standings.team-standings'],
    ]
])
