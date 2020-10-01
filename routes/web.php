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

	Route::get('student-register', 'AccountsController@register')->name("student_register");
	Route::post('student-check', 'AccountsController@student_check')->name('student_check');
	Route::get('student-password/{lrn}', 'AccountsController@student_password')->name('student_password');
	
	Route::put('student-account-create/{lrn}', 'AccountsController@student_account_create')->name('student_account_create');

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
	Route::post('data-record-score', 'StudentController@api_record_score');
	Route::post('data-remarks-remedial', 'StudentController@api_remarks_remedial');
	Route::post('insert-core-values', 'StudentController@api_insert_values');
	Route::get('data-qtr-record', 'StudentController@api_qtr_record');
	Route::post('update-profile-pic', 'AccountsController@updateProfilePic');
	
});


Route::middleware('auth:web')->group(function(){
	
	Route::prefix('dashboard')->group(function() {

		Route::get('/', 'DashboardController@index')->name('guest_dashboard');

	});

	Route::prefix('student')->group(function() {

		Route::get('records', 'DashboardController@dashboard_student_records')->name('student_record');

	});

	Route::prefix('teacher')->group(function() {
		
		Route::get('list-students/{year?}', 'StudentController@list_students')->name('lists_student');
		
		Route::get('student/record/{id}', 'StudentController@grade_record')->where('id', '[0-9]+')->name('teacher-student-record');

		Route::get('student/record/{id}/print', 'StudentController@print_grade_records')->where('id', '[0-9]+')->name('teacher-student-print-record');

		Route::get('account', 'TeacherController@account')->where('id', '[0-9]+')->name('teacher-account');

		Route::post('update-account', 'TeacherController@update_account')->where('id', '[0-9]+')->name('teacher-update-account');

		// Route::get('enroll/student/{id}/', 'StudentController@grade_enroll')->where('id', '[0-9]+')->name('teacher-student-enroll');

		Route::post('grade-enroll/add', 'StudentController@grade_enroll_add')->name('grade_enroll_add');

		Route::post('upload-profile_pic', 'AccountsController@uploadProfilePic')->name('upload-profile_pic');

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

		Route::get('students/{id}', 'StudentController@show')->where('id', '[0-9]+')->name('single_student');

		Route::resource('students', 'StudentController')->only([
		    'store', 'create', 'index', 'edit', 'update'
		])->names([
		    'store' => 'student.addStudent',
		    'edit' => 'student.editStudent',
		    'update' => 'student.updateStudent'
		]);

		Route::resource('teachers', 'TeacherController')->only([
		    'store', 'create', 'index', 'show', 'edit', 'update'
		])->names(
			[	
				'index' => 'teacher_all',
				'create' => 'teacher_create',
				'show' => 'single_teacher',
				'store' => 'teacher_docreate'
			]
		);

		Route::resource('subjects', 'SubjectController')->only([
		    'store', 'create', 'index'
		]);
		
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

		Route::post('grade-enroll/add-other-eligibility', 'StudentController@add_other_eligibities')->name('admin-add_other_eligibities');

		Route::get('student/record/{id}', 'StudentController@grade_record')->where('id', '[0-9]+')->name('admin-student-record');

		Route::get('student/record/{id}/print', 'StudentController@print_grade_records')->where('id', '[0-9]+')->name('admin-student-print-record');

		Route::get('student/print-record/{id}', 'RecordsController@print_report_card')->where('id', '[0-9]+')->name('admin-student-printrecord');

		Route::get('account/create/{type?}/{id?}', 'AdminController@create_account')->name("admin-create-account");

		Route::put('account/create/{type}/{id}', 'AdminController@docreate_account')->name("admin-docreate-account");

		Route::get('logout', 'AccountsController@account_logout')->name('logout');
	});

});


Route::resource('records', 'RecordsController')->only([
    'store', 'create', 'index', 'show', 'edit', 'update'
]);



