<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseClassController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ClothingController;
use App\Http\Controllers\PartnerTrainingUserController;
use App\Http\Controllers\MaterialUserController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Auth\LoginController;

//Main Page
Route::get('/', function () {
    return view('master.main');
})->name('master.main')->middleware('auth');

//Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Route::middleware('throttle:5,1')->group(function () {
//    Route::post('users.create', 'UserController@create')->name('users.create');
//    Route::post('materials.create', 'MaterialController@create')->name('materials.create');
//    Route::post('tickets.create', 'TicketController@create')->name('tickets.create');
//    Route::post('external.create', 'PartnerTrainingUserController@create')->name('external.create');
//    Route::post('partners.create', 'PartnerController@create')->name('partners.create');
//    Route::post('courses.create', 'CourseController@create')->name('courses.create');
//    Route::post('course-classes.create', 'CourseClassController@create')->name('course-classes.create');
//});

//Tecnico & Admin
Route::middleware(['auth', 'checkRole:admin,tecnico'])->group(function () {
    //Route::get('/home', 'HomeController@index')->name('home');
    //Route::resource('students', 'StudentController');

    Route::resource('users', 'UserController');
    Route::post('users/massDelete', 'UserController@massDelete')->name('users.massDelete');

    Route::resource('materials', 'MaterialController');
    Route::post('materials/massDelete', 'MaterialController@massDelete')->name('materials.massDelete');

    Route::resource('trainings', 'TrainingController');
    Route::post('trainings/massDelete', 'TrainingController@massDelete')->name('trainings.massDelete');

    Route::resource('clothing', 'ClothingController');

    Route::resource('clothing-assignment', 'ClothingAssignmentController');
    Route::get('/clothing-assignment/users/{id}', 'ClothingAssignmentController@index')->name('clothing-assignment.users');

    Route::resource('material-user', 'MaterialUserController');
    Route::post('material-user/massDelete', 'MaterialUserController@massDelete')->name('material-user.massDelete');

    Route::resource('partners', 'PartnerController');
    Route::delete('partner-contact/{partner_contact}', 'PartnerController@destroyContact')->name('partner-contact.destroy');
    Route::post('partners/massDelete', 'PartnerController@massDelete')->name('partners.massDelete');

    Route::post('external/updateTab', 'PartnerTrainingUserController@updateTab')->name('external.updateTab');
    Route::resource('external', 'PartnerTrainingUserController');
    Route::post('external/massDelete', 'PartnerTrainingUserController@massDelete')->name('external.massDelete');

    Route::get('/material-user/create/{id}', 'MaterialUserController@create')->name('material-user.create');
    Route::post('/material-user', 'MaterialUserController@store')->name('material-user.store');

    Route::resource('course-classes', 'CourseClassController');
    Route::post('course-classes/massDelete', 'CourseClassController@massDelete')->name('course-classes.massDelete');
    Route::post('course-classes/studentsImport', 'CourseClassController@studentsImport')->name('course-classes.studentsImport');

    Route::resource('courses', 'CourseController');
    Route::post('courses/massDelete', 'CourseController@massDelete')->name('courses.massDelete');

    Route::put('/tickets/{ticket}', 'TicketController@update')->name('tickets.update');
    Route::get('/tickets/restore/{id}', 'TicketController@restore')->name('tickets.restore');
    Route::delete('/tickets/forceDelete/{id}', 'TicketController@forceDelete')->name('tickets.forceDelete');

    Route::post('/comments', 'CommentController@store')->name('comments.store');

    Route::resource('import-excel', 'ExcelImportController');
    Route::redirect('/import-excel', '/users');
    Route::post('import-excel-users', 'ExcelImportController@importUsers')->name('import-excel.importUsers');
    Route::get('import-excel-students', 'ExcelImportController@index');
    Route::post('import-excel-students', 'ExcelImportController@importStudents')->name('import-excel.importStudents');
    Route::post('users/{user}/restore', 'UserController@restore')->name('users.restore');
    Route::delete('users/{user}/forceDelete', 'UserController@forceDelete')->name('users.forceDelete');



    Route::resource('/dashboard', 'DashboardController');
});

Route::middleware(['auth', 'checkRole:admin,tecnico,funcionario'])->group(function () {
    Route::resource('tickets', 'TicketController');
    Route::get('ticket-histories', 'TicketHistoryController@index');
    Route::get('ticket-histories/{id}', 'TicketHistoryController@show')->name('ticket-histories.show');

    Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');
    Route::put('users/{user}', 'UserController@update')->name('users.update');
});
