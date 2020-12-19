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

//Route::get('/', function () {
//    return view('home');
//});

Route::redirect('/', 'dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');

    Route::resource('signup', \App\Http\Controllers\SignupController::class)->only('index', 'create', 'store');
    Route::resource('races', \App\Http\Controllers\RaceController::class);
    Route::resource('race.results', \App\Http\Controllers\Race\RaceResultsController::class);
    Route::resource('race.quali-results', \App\Http\Controllers\Race\RaceQualiResultsController::class);
    Route::resource('standings', \App\Http\Controllers\StandingController::class);
    Route::resource('divisions.standings', \App\Http\Controllers\Division\StandingController::class);
});
