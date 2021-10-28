<?php

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

require __DIR__.'/auth.php';

Route::get('divisions/{division}/team-standings', '\App\Http\Controllers\Division\StandingController@teamStandings')
    ->name('standings.team-standings');
Route::get('divisions/{division}/matrix', '\App\Http\Controllers\Division\StandingController@matrix')
    ->name('standings.matrix');
Route::get('divisions/{division}/plot', '\App\Http\Controllers\Division\StandingController@plot')
    ->name('standings.plot');

Route::resource('standings', \App\Http\Controllers\StandingController::class);

Route::get('/api/races', '\App\Http\Controllers\Api\RaceController@index');
Route::get('races/list', '\App\Http\Controllers\RaceController@list')->name('races.list');
Route::get('races/{race}/broadcast', '\App\Http\Controllers\RaceController@broadcast')->name('races.broadcast');

Route::resource('races', \App\Http\Controllers\RaceController::class)->only('index');
Route::resource('race.results', \App\Http\Controllers\Race\RaceResultsController::class);
Route::resource('race.quali-results', \App\Http\Controllers\Race\RaceQualiResultsController::class);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/auth/discord', [\App\Http\Controllers\Auth\DiscordAuthController::class, 'redirect'])->name('auth.discord');
    Route::get('/auth/discord/callback', [\App\Http\Controllers\Auth\DiscordAuthController::class, 'callback']);

    Route::get('dashboard', '\App\Http\Controllers\DashboardController@index')->name('dashboard');

    Route::get('profile/protests', '\App\Http\Controllers\ProfileController@protests')
        ->name('profile.protests');

    Route::get('divisions/{division}/export', '\App\Http\Controllers\DivisionController@export')
        ->name('standings.export');

    Route::resource('divisions', \App\Http\Controllers\DivisionController::class)->only('index');
    Route::resource('signup', \App\Http\Controllers\SignupController::class)->only('index', 'create', 'store');
    Route::resource('drivers', \App\Http\Controllers\DriverController::class)->only(['edit', 'update', 'show']);
    Route::resource('driver-videos', \App\Http\Controllers\DriverVideoController::class)->only(['store']);
    Route::get('races/{race}/protests', '\App\Http\Controllers\Race\ProtestsController@index')->name('races.protests');

    Route::resource('protests', \App\Http\Controllers\ProtestController::class);
});
