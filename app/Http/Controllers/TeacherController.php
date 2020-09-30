<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\{Teachers, Grade_sections};


class TeacherController extends Controller{

	function index(){

		$teachers = Teachers::all();

		$obj = [
			'teachers' => $teachers
		];

		return view('admin.admin-teachers', $obj);

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

}