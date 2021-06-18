<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between text-gray-800 dark:text-gray-100">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Races') }}
            </h2>

            <div>
                <a href="{{ route('races.list') }}" title="List View">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-700 shadow overflow-hidden sm:rounded-md">
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
                        var calendar = new FullCalendar.Calendar(calendarEl, {
                            initialView: 'dayGridMonth',
                            events: '/api/races',
                            headerToolbar: {
                                start: 'today prev,next', // will normally be on the left. if RTL, will be on the right
                                center: 'title',
                                end: 'dayGridMonth dayGridWeek dayGridDay listDay' // will normally be on the right. if RTL, will be on the left
                            }
                        });
                        calendar.render();
                    });

                </script>
            </div>
        </div>
    </div>

</x-app-layout>
