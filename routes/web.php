<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(GameController::class)->group(function () {
    Route::get('/', 'index')->name('game.index');
    Route::post('/start', 'start')->name('game.start');
    Route::get('/play', 'play')->name('game.play');
    Route::post('/answer', 'answer')->name('game.answer');
    Route::get('/finish', 'finish')->name('game.finish');
});
