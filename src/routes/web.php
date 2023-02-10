<?php
use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Pebblemark\Profile\Http\Controllers',
    'middleware' => ['web']
], function () {
    Route::get('profile', 'ProfileController@profile')->name('profile')->middleware(['auth']);
    Route::put('profile', 'ProfileController@updateProfile')->name('updateProfile')->middleware(['auth']);
    Route::get('profile/{image}', 'ProfileController@profileImage')->name('profileImage')->middleware(['auth']);
    Route::put('password/Update', 'ProfileController@passwordUpdate')->name('passwordUpdate')->middleware(['auth']);
});