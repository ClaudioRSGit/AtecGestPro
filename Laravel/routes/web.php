<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseClassController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ClothingController;
use App\Http\Controllers\PartnerTrainingsUsersController;

Route::get('/', function () {
    return view('master.main');
});



Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UserController');

Route::resource('tickets', 'TicketController');

Route::resource('materials', 'MaterialController');

Route::resource('trainings', 'TrainingController');

//Route::resource('students', 'StudentController');

Route::resource('clothing', 'ClothingController');

Route::resource('clothing-assignment', 'ClothingAssignmentController');
Route::get('/clothing-assignment/users/{id}', 'ClothingAssignmentController@index')->name('clothing-assignment.users');

Route::resource('external', 'PartnerTrainingsUsersController');

Route::resource('partners', 'PartnerController');








Route::resource('course-classes', 'CourseClassController');

Route::resource('courses', 'CourseController');

Route::post('materials/massDelete', 'MaterialController@massDelete')->name('materials.massDelete');

Route::post('users/massDelete', 'UserController@massDelete')->name('users.massDelete');

Route::post('courses/massDelete', 'CourseController@massDelete')->name('courses.massDelete');

Route::post('partners/massDelete', 'PartnerController@massDelete')->name('partners.massDelete');
