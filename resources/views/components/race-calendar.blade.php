
@props([
    'config' => [
        'initialView' => 'dayGridMonth',
        'events' => '/api/races',
        'headerToolbar' => [
            'start' => 'today prev,next', // will normally be on the left. if RTL, will be on the right
            'center' => 'title',
            'end' => 'dayGridMonth dayGridWeek dayGridDay listDay' // will normally be on the right. if RTL, will be on the left
        ]
    ]
])

<div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.css" integrity="sha256-u40zn9KeZYpMjgYaxWJccb4HnP0i8XI17xkXrEklevE=" crossorigin="anonymous">
    <style>
        .fc-event {
            white-space: normal;
        }
    </style>

    <div class="p-6 text-gray-800 dark:text-gray-100" id="calendar"></div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.js" integrity="sha256-AOrsg7pOO9zNtKymdz4LsI+KyLEHhTccJrZVU4UFwIU=" crossorigin="anonymous"></script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {{ Illuminate\Support\Js::from($config) }});
            calendar.render();
        });

    </script>
</div>
