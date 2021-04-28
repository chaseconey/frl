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

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', '\App\Http\Controllers\DashboardController@index')->name('dashboard');

    Route::put('drivers/{driver}/toggle-claim', '\App\Http\Controllers\DriverController@toggleClaim')
        ->name('drivers.toggle-claim');

    Route::get('profile/protests', '\App\Http\Controllers\ProfileController@protests')
        ->name('profile.protests');

    Route::get('divisions/{division}/standings', '\App\Http\Controllers\Division\StandingController@standings')
        ->name('standings.standings');
    Route::get('divisions/{division}/team-standings', '\App\Http\Controllers\Division\StandingController@teamStandings')
        ->name('standings.team-standings');
    Route::get('divisions/{division}/matrix', '\App\Http\Controllers\Division\StandingController@matrix')
        ->name('standings.matrix');
    Route::get('divisions/{division}/export', '\App\Http\Controllers\DivisionController@export')
        ->name('standings.export');

    Route::resource('signup', \App\Http\Controllers\SignupController::class)->only('index', 'create', 'store');
    Route::resource('drivers', \App\Http\Controllers\DriverController::class)->only(['edit', 'update', 'show']);
    Route::resource('driver-videos', \App\Http\Controllers\DriverVideoController::class)->only(['store']);
    Route::get('races/{race}/broadcast', '\App\Http\Controllers\RaceController@broadcast')->name('races.broadcast');
    Route::get('races/{race}/protests', '\App\Http\Controllers\Race\ProtestsController@index')->name('races.protests');
    Route::resource('races', \App\Http\Controllers\RaceController::class)->only('index');
    Route::resource('divisions', \App\Http\Controllers\DivisionController::class)->only('index');
    Route::resource('race.results', \App\Http\Controllers\Race\RaceResultsController::class);
    Route::resource('race.quali-results', \App\Http\Controllers\Race\RaceQualiResultsController::class);
    Route::resource('standings', \App\Http\Controllers\StandingController::class);
    Route::resource('protests', \App\Http\Controllers\ProtestController::class);
});
