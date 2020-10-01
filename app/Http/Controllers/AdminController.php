<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\{Admin_accounts, Grade_sections, Teachers, Subjects, Guest_accounts};
use App\Services\School_class;


class AdminController extends Controller{


	function login(){

		return view('admin.admin-login');
	}

	function do_login(Request $r){
		$user = $r->username;
		$pass = $r->password;
		if(Auth::guard('admin')->attempt(['username' => $user, 'password' => $pass])){
			return redirect('/admin/teachers');
		}
		return redirect('/admin');
	}

	function register(){

		return view('admin.admin-register');
	}

	function do_register(Request $r){

		$fname = $r->fname;
		$mname = $r->mname;
		$lname = $r->lname;
		$username = $r->username;
		$password = $r->password;

		$new = new Admin_accounts;
		$new->fname = $fname;
		$new->mname = $mname;
		$new->lname = $lname;
		$new->username = $username;
		$new->password = Hash::make($password);

		$new->save();

		if($new->id){
			return redirect()->route('done_register');
		}

	}

	function sections(){

		$all = Grade_sections::all();

		$obj = [
			'sections' => $all
		];

		return view('admin.admin-section', $obj);
	}

	function section_create(){
		$teacher = Teachers::all();
		$teacher_arr = [];
		foreach($teacher as $t){
			$teacher_arr[$t->id] = $t->fullname;
		}

		$obj = [
			'teachers' => $teacher_arr
		];

		return view('admin.admin-section_create', $obj);
	}

	function section_edit($id){
		$section = Grade_sections::find($id);

		$teacher = Teachers::all();
		$teacher_arr = [];
		foreach($teacher as $t){
			$teacher_arr[$t->id] = $t->fullname;
		}

		$obj = [
			'section' => $section,
			'teachers' => $teacher_arr
		];

		return view('admin.admin-section_edit', $obj);
	}

	function section_docreate(Request $r){

		$validatedData = $r->validate([
	        'sectionname' => 'required',
	        'gradelevel' => 'required',
	    ]);

		$sectionname = $r->sectionname;
		$gradelevel = $r->gradelevel;

		$new = new Grade_sections;
		$new->sectionname = $sectionname;
		$new->gradelevel = $gradelevel;
		$new->date_created = time();
		
		if($new->save()){
			return redirect()->route('section_all');
		}

		return redirect()->route('section_all');
	}

	function section_doedit(Request $r){
		
		$validatedData = $r->validate([
	        'sectionname' => 'required',
	        'gradelevel' => 'required',
	    ]);

		$id = $r->id;
		$secname = $r->sectionname;
		$gradelevel = $r->gradelevel;

		$find = Grade_sections::find($id);

		if($find->exists()){
			$find->update([
				'sectionname' => $secname,
				'gradelevel' => $gradelevel
			]);
		}

		return redirect()->route('section_all');
	}

	function subjects(){

		$subject = Subjects::all();
		$parents = [];
		foreach($subject as $s){
			$has_par = $s->parent_subject($s->parent_id);

			if($has_par->exists()){
				$parents[$s->parent_id] = $has_par->first()->subjname;
			}
		}

		$obj = [
			'subject' => $subject,
			'parents' => $parents
		];

		return view('admin.admin-subjects', $obj);
	}


	function subject_create(){
		$subject = Subjects::all();
		$parents = [];
		$parents[0] = "None";
		foreach($subject as $s){
			$parents[$s->id] = $s->subjname;
		}
		$obj = [
			'subject' => $subject,
			'parents' => $parents
		];

		return view('admin.admin-subject_create', $obj);
	}

	function subject_docreate(Request $r){
		$subjcode = $r->subjcode;
		$subjname = $r->subjname;
		$gradelevel = $r->gradelevel;
		$parent_id = $r->parent_id;

		$new = new Subjects;
		$new->subjcode = $subjcode;
		$new->subjname = $subjname;
		$new->gradelevel = $gradelevel;
		$new->parent_id = $r->parent_id;
		$new->date_created = time();
		
		if($new->save()){
			return redirect()->route('subject_all');
		}

	}

	function create_account($type = null, $id = null){

		if($type == 'students'){
			$students = Students::all();
			$obj = [
				'users' => $teachers
			];
			return view('admin.admin-account_student', $obj);

		}

		else if($type == 'teachers'){
			$teachers = Teachers::all();

			$obj = [
				'users' => $teachers,
			];

			return view('admin.admin-account_teacher', $obj);

		}
	
		$guess = Guest_accounts::where([
				['account_type_label', '=', ucfirst($type)],
				['account_id', '=', $id],
			])->get();

		if($id != null){
			
			$teacher = Teachers::find($id);

			$obj = [
				'user' => $teacher,
				'guess' => $guess
			];
			return view('admin.admin-account_form', $obj);
		}

		return view('admin.admin-type_account');
		
	}

	function docreate_account(Request $r, $type, $id){
		$validatedData = $r->validate([
	        'email' => 'required|e-mail',
	        'password' => 'required|same:confirm|string|min:5',
	        'confirm' => 'required|string|same:password'
	    ],[
	    	'email.required' => "Your email is required",
	    	'password.same' => "Your password is not match",
	    	'password.required' => "Your password is required",
	    	'confirm.same' => "Confirm your password"
	    ]);

		$model = "";
		if($type == 'teacher'){
			$model = "App\Models\Teachers";
		}
		else if($type == 'student'){
			$model = "App\Models\Students";	
		}

		$update = Guest_accounts::where([
			['account_type_label', '=', ucfirst($type)],
			['account_id', '=', $id],
		]);

		if($update->exists()){
			$update->update([
				'username' => $r->email,
				'email' => $r->email,
				'password' => Hash::make($r->password),
				'account_type' => $model,
				'account_type_label' => ucfirst($type),
				'is_active' => 1,
				'account_id' => $id,
				'date_updated' => date("Y-m-d", time()),
			]);
		}else{
			$new = new Guest_accounts;
			$new->username = $r->email;
			$new->email = $r->email;
			$new->password = Hash::make($r->password);
			$new->account_type = $model;
			$new->account_type_label = ucfirst($type);
			$new->is_active = 1;
			$new->account_id = $id;
			$new->date_created = date("Y-m-d", time());
			$new->date_updated = date("Y-m-d", time());
			$new->save();
		}

		return redirect()->route("admin-create-account", ['type' => $type, 'id' => $id])->with('success', "Successfully Updated");

	}
}