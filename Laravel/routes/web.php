<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('dashboard', 'DashboardController');

Route::resource('users', 'UserController');

Route::resource('tickets', 'TicketController');

Route::resource('material', 'MaterialController');

Route::resource('trainings', 'TrainingsController');

Route::resource('clothing', 'ClothingController');

Route::resource('classes', 'CourseClassController');
