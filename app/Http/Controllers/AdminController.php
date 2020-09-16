<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\{Admin_accounts, Grade_sections, Teachers, Subjects};
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
		$sectionname = $r->sectionname;
		$gradelevel = $r->gradelevel;
		$teacher = $r->teacher;

		$new = new Grade_sections;
		$new->sectionname = $sectionname;
		$new->gradelevel = $gradelevel;
		$new->date_created = time();
		if($new->save()){
			$find = Teachers::find($teacher);
			if($find->exists()){
				$find->update(['section_id' => $new->id]);
			}
		}
		return redirect()->route('section_all');
	}

	function section_doedit(Request $r){
		$id = $r->id;
		$secname = $r->sectionname;
		$gradelevel = $r->gradelevel;
		$teacher = $r->teacher;

		$find = Grade_sections::find($id);
		if($find->exists()){
			$find->update([
				'sectionname' => $secname,
				'gradelevel' => $gradelevel
			]);

			$find = Teachers::where('section_id', $id);
			
			if($find->exists()){
				$find->update(['section_id' => 0]);
			}

			$find = Teachers::find($teacher);
			if($find->exists()){
				$find->update(['section_id' => $id]);
			}
		}

		return redirect()->route('section_all');
	}

	function subjects(){

		$subject = Subjects::all();
		$parents = [];
		foreach($subject as $s){
			$has_par = $s->parent_subject($s->id);
			if($has_par->exists()){
				$parents[$has_par->first()->subjcode] = $s->subjname;
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
}