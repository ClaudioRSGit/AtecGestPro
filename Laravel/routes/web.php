<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseClassController;
use App\Http\Controllers\MaterialController;

Route::get('/', function () {
    return view('master.main');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UserController');

Route::resource('tickets', 'TicketController');

Route::resource('materials', 'MaterialController');
Route::delete('/materials/{material}', 'MaterialController@destroy')->name('materials.destroy');
Route::put('/materials/{material}', 'MaterialController@update')->name('materials.update');

Route::resource('trainings', 'TrainingsController');
