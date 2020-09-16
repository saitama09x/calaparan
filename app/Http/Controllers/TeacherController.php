<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\{Teachers, Grade_sections};


class TeacherController extends Controller{


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
		$t->yr_from = $r->yr_from;
		$t->yr_to = $r->yr_to;
		$t->classgrade = $r->classgrade;
		$t->datecreated = date("Y-m-d H:i:s", time());
		$t->save();

		if($t->id){
			return redirect()->route('teacher_all');
		}

	}

	function admin_show_all(){

		$teachers = Teachers::all();

		$obj = [
			'teachers' => $teachers
		];

		return view('admin.admin-teachers', $obj);

	}

	function single_teacher($teacher_id){

		$teacher = Teachers::find($teacher_id);

		$obj = [
			'teacher' => $teacher
		];

		return view('teachers.admin-single-teacher', $obj);
	}

}