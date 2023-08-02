<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('artist', 'ArtistCrudController');
    Route::crud('artist-type', 'ArtistTypeCrudController');
    Route::crud('locality', 'LocalityCrudController');
    Route::crud('location', 'LocationCrudController');
    Route::crud('representation', 'RepresentationCrudController');
    Route::crud('representation-user', 'RepresentationUserCrudController');
    Route::crud('role', 'RoleCrudController');
    Route::crud('role-user', 'RoleUserCrudController');
    Route::crud('show', 'ShowCrudController');
    Route::crud('type', 'TypeCrudController');
    Route::crud('user', 'UserCrudController');
}); // this should be the absolute last line of this file