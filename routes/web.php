<?php

use App\Http\Controllers\Api\RaceResults\LapController;
use App\Http\Controllers\Auth\DiscordAuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CalendarCreatorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DriverVideoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProtestController;
use App\Http\Controllers\Race\ProtestsController;
use App\Http\Controllers\Race\RaceQualiResultsController;
use App\Http\Controllers\Race\RaceResultsController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\StandingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

require __DIR__ . '/auth.php';

Route::get('divisions/{division}/team-standings', [\App\Http\Controllers\Division\StandingController::class, 'teamStandings'])
    ->name('standings.team-standings');
Route::get('divisions/{division}/matrix', [\App\Http\Controllers\Division\StandingController::class, 'matrix'])
    ->name('standings.matrix');
Route::get('divisions/{division}/plot', [\App\Http\Controllers\Division\StandingController::class, 'plot'])
    ->name('standings.plot');
Route::resource('blog', BlogController::class)->only(['index', 'show']);

Route::resource('standings', StandingController::class);

Route::get('/api/races', [\App\Http\Controllers\Api\RaceController::class, 'index']);
Route::get('races/list', [RaceController::class, 'list'])->name('races.list');
Route::get('races/{race}/broadcast', [RaceController::class, 'broadcast'])->name('races.broadcast');

Route::resource('races', RaceController::class)->only('index');
Route::resource('race.results', RaceResultsController::class);
Route::resource('race.quali-results', RaceQualiResultsController::class);
Route::get('/api/race-results/{result}/laps', [LapController::class, 'index']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/auth/discord', [DiscordAuthController::class, 'redirect'])->name('auth.discord');
    Route::get('/auth/discord/callback', [DiscordAuthController::class, 'callback']);

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('profile/protests', [ProfileController::class, 'protests'])->name('profile.protests');

    Route::get('divisions/{division}/export', [DivisionController::class, 'export'])
        ->name('standings.export');

    Route::resource('divisions', DivisionController::class)->only('index');
    Route::resource('signup', SignupController::class)->only('index', 'create', 'store');
    Route::resource('drivers', DriverController::class)->only(['edit', 'update', 'show']);
    Route::resource('driver-videos', DriverVideoController::class)->only(['store']);
    Route::get('races/{race}/protests', [ProtestsController::class, 'index'])->name('races.protests');

    Route::resource('protests', ProtestController::class);

    Route::resource('calendar-creator', CalendarCreatorController::class)
        ->only(['index', 'store'])
        ->middleware('can:manage-races');
});
