<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Artist Routes
|--------------------------------------------------------------------------
*/

Route::get('/artist', [ArtistController::class, 'index',])
    ->name('artist.index');
Route::get('/artist/{id}', [ArtistController::class,'show',])
    ->where('id', '[0-9]+')
    ->name('artist.show');


/*
|--------------------------------------------------------------------------
| Location Routes
|--------------------------------------------------------------------------
*/

Route::get('/location', [LocationController::class, 'index',])
    ->name('location.index');
Route::get('/location/{slug}', [LocationController::class, 'show',])
    ->where('id', '[0-9]+')->name('location.show');

/*

/*
|--------------------------------------------------------------------------
| Show Routes
|--------------------------------------------------------------------------
*/

Route::get('/show', [ShowController::class, 'index',])
    ->name('show.index');
Route::get('/show/{slug}', [ShowController::class, 'show'])->name('show.show');
Route::get('/show/{slug}/representations', [ShowController::class, 'representations',])
    ->where('id', '[0-9]+')->name('show.representations');

Route::group([
    'prefix' => '/reservation',
    'as'=>'stripe.',
    'middleware' => 'auth',
], function(){
    Route::post('/checkout', [StripeController::class, 'index'])
        ->name('checkout');
    Route::post('/payment', [StripeController::class, 'store'])
        ->name('confirm');
    Route::get('/success?{id}_{qte}', [StripeController::class, 'success'])
        ->name('success');
});


require __DIR__.'/auth.php';
