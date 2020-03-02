<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\{Teachers};


class TeacherController extends Controller{


	function create(){

		$teachers = Teachers::all();

		$obj = [
			'teachers' => $teachers
		];

		return view('teachers.createTeacher', $obj);
	}

	function store(Request $r){

		$t = new Teachers;

		$t->fullname = $r->fullname;
		$t->sectname = $r->sectname;
		$t->schooolyr = $r->schooolyr;
		$t->classgrade = $r->classgrade;
		$t->datecreated = date("Y-m-d H:i:s", time());
		$t->save();

	}

}