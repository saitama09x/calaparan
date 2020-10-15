<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\{Teachers, Grade_sections, Guest_accounts};
use App\Services\UploadHandler;

class TeacherController extends Controller{

	function index(){

		$teachers = Teachers::all();

		$obj = [
			'teachers' => $teachers
		];

		return view('admin.admin-teachers', $obj);

	}

	function list_students($year = null){

		if($year != null){

			$id = Auth::user()->account_id;

			$enrolls = Student_enrolls::where([
				[ 'teacher_id', '=', $id],
				[ 'yr_from', '=', $year]
			])->get();

			$obj = [
				'enrolls' => $enrolls,
				'year_from' => $year,
				'year_to' => $year + 1
			];

			return view('students.teacher-list_student', $obj);

		}

		$id = Auth::user()->account_id;
		$history = Student_enrolls::select("yr_from")->where('teacher_id', $id)->orderBy("yr_from", "DESC")->groupBy('yr_from')->get();

		$obj = [
			'history' => $history
		];

		return view('students.teacher-list_year', $obj);
		
	}
	
	function create(){

		$teachers = Teachers::all();
		$sections = Grade_sections::all();
		$section_val = [];

		foreach($sections as $s){
			$section_val[$s->id] = $s->sectionname;
		}

		$obj = [
			'teachers' => $teachers,
			'section' => $sections,
			'section_val' => $section_val
		];

		return view('teachers.createTeacher', $obj);
	}

	function store(Request $r){

		$t = new Teachers;

		$t->fullname = $r->fullname;
		$t->section_id = $r->sectname;
		$t->datecreated = date("Y-m-d H:i:s", time());
		$t->save();

		if($t->id){
			return redirect()->route('teacher_all');
		}

	}

	
	function show($teacher_id){

		$teacher = Teachers::find($teacher_id);

		$obj = [
			'teacher' => $teacher
		];

		return view('teachers.admin-single-teacher', $obj);
	}

	function edit($teacher_id){

		$teacher = Teachers::find($teacher_id);
		$sections = Grade_sections::all();
		$section_val = [];

		foreach($sections as $s){
			$section_val[$s->id] = $s->sectionname;
		}

		$obj = [
			'teacher' => $teacher,
			'section_val' => $section_val
		];

		return view('teachers.admin-edit-teacher', $obj);
	}

	function update(Request $r, $id){

		$update = Teachers::find($id);

		if($update->exists()){
			$update->fullname = $r->fullname;
			$update->section_id = $r->sectname;
			$update->save();

			return redirect()->route('teacher_all');
		}
	}

	function account(){

		$auth = Auth::user();
		$user = Teachers::where("id", $auth->account_id)->get();

		$obj = [
			'teacher' => $user->first(),
			'auth' => $auth
		];

		return view('teachers.accountTeacher', $obj);
	}

	function update_account(Request $r){
		
		$auth = Auth::user();

		$validatedData = $r->validate([
	        'username' => 'required',
	        'email' => 'required|e-mail',
	        'password' => 'required|same:confirm|string|min:5',
	        'confirm' => 'required|string|same:password'
	    ], [
	    	'username.required' => "Your username is required",
	    	'email.required' => "Your email is required",
	    	'password.same' => "Your password is not match",
	    	'password.required' => "Your password is required",
	    	'confirm.same' => "Confirm your password"
	    ]);

	    $find = Guest_accounts::where([
	    	['account_type_label', "=", "Teacher"],
	    	['account_id', "=", $auth->account_id],
	    ]);

	    if($find->exists()){
	    	$update = $find->update([
	    		'username' => $r->username,
	    		'email' => $r->email,
	    		'password' => Hash::make($r->password)
	    	]);

	    	return redirect()->route('teacher-account')->with('account_updated', "Successfully Updated");
	    }

	    return redirect()->route('teacher-account')->with('account_error', "Not Updated, Please check.");
	}

}