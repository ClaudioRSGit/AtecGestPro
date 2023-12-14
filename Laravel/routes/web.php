<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseClassController;
use App\Http\Controllers\MaterialController;

Route::get('/', function () {
    return view('master.main');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::resource('dashboard', 'DashboardController');

Route::resource('users', 'UserController');
Route::get('/users/create', 'UserController@create')->name('users.create');

Route::resource('tickets', 'TicketController');

Route::resource('materials', 'MaterialController');
Route::get('/materials/{material}', 'MaterialController@show')->name('materials.show');
Route::get('/materials/create', 'MaterialController@create')->name('materials.create');
Route::get('/materials/{material}/edit', 'MaterialController@edit')->name('materials.edit');


Route::resource('trainings', 'TrainingsController');

Route::resource('classes', CourseClassController::class);
