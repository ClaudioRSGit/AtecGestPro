<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseClassController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ClothingController;

Route::get('/', function () {
    return view('master.main');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UserController');

Route::resource('tickets', 'TicketController');

Route::resource('materials', 'MaterialController');

Route::resource('trainings', 'TrainingController');

<<<<<<< HEAD
Route::resource('students', 'StudentController');

Route::resource('course-classes', 'CourseClassController');

Route::resource('clothing', 'ClothingController');
=======
Route::resource('classes', 'CourseClassController');

Route::resource('clothing', 'ClothingController');



>>>>>>> b3744e6e42f855e008273c9b3607f62106dd5785
