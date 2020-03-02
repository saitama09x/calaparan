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
    return view('welcome');
});

Route::get('/dashboard', 'DashboardController@index');

Route::resource('students', 'StudentController')->only([
    'store', 'create', 'index', 'show'
])->names([
    'store' => 'student.addStudent',
]);

Route::resource('teachers', 'TeacherController')->only([
    'store', 'create', 'index', 'show'
]);

Route::resource('subjects', 'SubjectController')->only([
    'store', 'create', 'index', 'show'
]);

Route::resource('records', 'RecordsController')->only([
    'store', 'create', 'index', 'show', 'edit', 'update'
]);