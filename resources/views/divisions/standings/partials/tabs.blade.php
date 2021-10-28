
@include('components.tabs', [
    'links' => [
        ['title' => 'Race Matrix', 'link' => route('standings.matrix', ['division' => $division]), 'activeRoute' => 'standings.matrix'],
        ['title' => 'Standings Tracker', 'link' => route('standings.plot', ['division' => $division]), 'activeRoute' => 'standings.plot'],
        ['title' => 'Constructor Points', 'link' => route('standings.team-standings', ['division' => $division]), 'activeRoute' => 'standings.team-standings'],
    ]
])
