<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\{Students, Teachers, Grade_subjects};

class SubjectController extends Controller{

	function create(){

		$teachers = Teachers::all();
		$teacher_list = [];
		if($teachers){
			foreach ($teachers as $t){
				 $teacher_list[$t->id] = $t->fullname;
			}
		}

		$obj = [
			'teachers' => $teachers,
			'teacher_list' => $teacher_list
		];

		return view('subjects.createSubject', $obj);
	}


	function store(Request $r){

		$s = new Grade_subjects;
		$s->subject_name = $r->subject_name;
		$s->teacher_id = $r->teacher_id;
		$s->datecreated = date("Y-m-d H:i:s", time());
		$s->save();
	}

}