<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

});

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('teachers', 'TeacherController');
Route::resource('students', 'StudentController');
Route::resource('streams', 'StreamController');
Route::resource('terms', 'TermController');
Route::resource('subjects', 'SubjectController');
Route::resource('classes', 'ClassesController');
Route::resource('exams', 'ExamController');
Route::resource('results', 'ResultsController');

Route::get('/years', 'HomeController@years');

Route::get('/classes/{class}/students', 'ClassesStudentsController@index');


Auth::routes();
