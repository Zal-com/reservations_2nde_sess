<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShowController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function(){
    return view('home');
})
->name('home');

//Artists routes
Route::get('/artist', [ArtistController::class, 'index'])
    ->name('artist.list');
Route::get('/artist/{name}-{firstname}', [ArtistController::class,'show'])
    ->name('artist.show');

//Shows routes
Route::get('/show', [ShowController::class, 'index'])
    ->name('show.list');

Route::get('/show/{slug}', [ShowController::class, 'show'])
    ->where('id', '[0-9]+')
    ->name('show.show');

//Location Routes
Route::get('/location', [LocationController::class,'index'])
    ->name('location.list');

Route::get('/location/{slug}', [LocationController::class, 'show'])
    ->name('location.element');
