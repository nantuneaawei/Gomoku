<?php

use App\Http\Controllers\Lession\Student;
use App\Http\Controllers\Lession\Game;

Route::get('/student', [Student::class, 'get']);
Route::get('/game', [Game::class, 'index']);
Route::post('/game', [Game::class, 'insert']);
Route::put('/game', [Game::class, 'update']);