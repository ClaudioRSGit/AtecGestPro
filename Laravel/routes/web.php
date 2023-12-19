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

Route::resource('students', 'StudentController');

Route::resource('clothing', 'ClothingController');

Route::resource('clothing-assignment', 'ClothingAssignmentController');

Route::resource('external', 'PartnerTrainingsUsersController');






Route::resource('course-classes', 'CourseClassController');

Route::resource('courses', 'CourseController');
