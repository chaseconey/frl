
@include('components.tabs', [
    'links' => [
        ['title' => 'Constructors Points', 'link' => route('standings.standings', ['division' => $division]), 'activeRoute' => 'standings.standings'],
        ['title' => 'Team Points', 'link' => route('standings.team-standings', ['division' => $division]), 'activeRoute' => 'standings.team-standings'],
        ['title' => 'Race Matrix', 'link' => route('standings.matrix', ['division' => $division]), 'activeRoute' => 'standings.matrix'],
    ]
])
