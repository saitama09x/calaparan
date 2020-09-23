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

Route::get('/', 'AccountsController@login')->name("guest_login");
Route::post('/dologin', 'AccountsController@account_login')->name('guest_do_login');

Route::prefix('account')->group(function() {

	Route::get('register', 'AccountsController@register')->name("guest_register");
	Route::post('register', 'AccountsController@account_register_add')->name('add_register');
	Route::get('register/done', 'AccountsController@register_done')->name('done_register');
	Route::get('logout', 'AccountsController@account_logout')->name('guest_logout');

});

Route::prefix('ajax-json')->group(function() {

	Route::post('data-students', 'DataTableController@studentList');
	Route::post('data-insert-record', 'RecordsController@api_insert_records');
	Route::post('data-insert-remarks', 'RecordsController@api_insert_remarks');
	Route::get('data-show-student', 'StudentController@api_show');
	Route::get('data-show-remedial', 'StudentController@api_remedial');
	Route::post('data-insert-remedial', 'StudentController@api_insert_remedial');
});


Route::middleware('auth:web')->group(function(){
	
	Route::prefix('dashboard')->group(function() {

		Route::get('/', 'DashboardController@index')->name('guest_dashboard');

	});

	Route::prefix('student')->group(function() {

		Route::get('records', 'DashboardController@dashboard_student_records')->name('student_record');

	});

	Route::prefix('teacher')->group(function() {
		Route::get('list-students', 'StudentController@index')->name('lists_student');
		Route::get('grade-record/{id}', 'StudentController@grade_record')->where('id', '[0-9]+');
		Route::get('grade-enroll/{id}', 'StudentController@grade_enroll')->where('id', '[0-9]+')->name('grade-enroll');
		Route::post('grade-enroll/add', 'StudentController@grade_enroll_add')->name('grade_enroll_add');
		Route::post('grade-enroll/add-eligibility', 'StudentController@add_eligibities')->name('add_eligibities');
	});

});


Route::get('/admin', 'AdminController@login');
Route::post('/admin', 'AdminController@do_login');
Route::get('/admin/register', 'AdminController@register')->name('admin_register');
Route::post('/admin/register', 'AdminController@do_register')->name('admin_doregister');;

Route::middleware('auth:admin')->group(function(){

	Route::prefix('admin')->group(function() {
		
		Route::get('dashboard', function(){
			return 'This is admin';
		})->name('admin_dashboard');

		Route::get('teachers', 'TeacherController@admin_show_all')->name('teacher_all');
		Route::get('teachers/create', 'TeacherController@create')->name('teacher_create');
		Route::get('teacher/{id}', 'TeacherController@single_teacher')->where('id', '[0-9]+')->name('single_teacher');

		Route::get('students/{id}', 'StudentController@show')->where('id', '[0-9]+')->name('single_student');

		Route::post('teachers/create', 'TeacherController@store')->name('teacher_docreate');
		Route::get('sections', 'AdminController@sections')->name('section_all');
		Route::get('section/create', 'AdminController@section_create')->name('section_create');
		Route::post('section/create', 'AdminController@section_docreate')->name('section_docreate');
		Route::get('section/edit/{id}', 'AdminController@section_edit')->where('id', '[0-9]+')->name('section_edit');
		Route::post('section/edit/update', 'AdminController@section_doedit')->name('section_doedit');
		Route::get('subjects', 'AdminController@subjects')->name('subject_all');
		Route::get('subject/create', 'AdminController@subject_create')->name('subject_create');
		Route::post('subject/create', 'AdminController@subject_docreate')->name('subject_docreate');
		
		Route::get('enroll/list-students', 'StudentController@index')->name('enroll_students');
		
		Route::get('enroll/student/{id}/', 'StudentController@grade_enroll')->where('id', '[0-9]+')->name('admin-student-enroll');

		Route::get('enroll/print/{id}/', 'StudentController@print_form_137')->where('id', '[0-9]+')->name('admin-print-enroll');
		
		Route::post('grade-enroll/add', 'StudentController@grade_enroll_add')->name('admin-grade_enroll_add');

		Route::post('grade-enroll/add-eligibility', 'StudentController@add_eligibities')->name('admin-add_eligibities');

		Route::get('student/record/{id}', 'StudentController@grade_record')->where('id', '[0-9]+')->name('admin-student-record');

		Route::get('student/print-record/{id}', 'RecordsController@print_report_card')->where('id', '[0-9]+')->name('admin-student-printrecord');

		Route::get('logout', 'AccountsController@account_logout')->name('logout');
	});

});


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



