<?php

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

Route::resource('students', 'StudentController');

Route::resource('clothing', 'ClothingController');

Route::resource('clothing-assignment', 'ClothingAssignmentController');
Route::get('/clothing-assignment/users/{id}', 'ClothingAssignmentController@index')->name('clothing-assignment.users');

Route::resource('external', 'PartnerTrainingsUsersController');
Route::get('/external/create-partner', 'PartnerTrainingsUsersController@createPartner')->name('external.createPartner');
Route::post('/external/store-partner', 'PartnerTrainingsUsersController@storePartner')->name('external.storePartner');
Route::get('/external/edit-partner', 'PartnerTrainingsUsersController@editPartner')->name('external.editPartner');







Route::resource('course-classes', 'CourseClassController');

Route::resource('courses', 'CourseController');

Route::post('materials/massDelete', 'MaterialController@massDelete')->name('materials.massDelete');

Route::post('users/massDelete', 'UserController@massDelete')->name('users.massDelete');
