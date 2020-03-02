<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\{Students};
class StudentController extends Controller{

	function __construct(){


	}

	function index(){

		return view('students.listStudent');

	}

	function store(Request $r){

		$student = new Students;

		$student->fname = $r->fname;
		$student->lname = $r->lname;
		$student->exname = $r->exname;
		$student->mname = $r->mname;
		$student->bday = $r->bday;
		$student->sex = $r->sex;
		$student->save();

	}

	function create(){

		$student = Students::all();

		$obj = [
			'student' => $student
		];

		return view('students.createStudent', $obj);

	}

	function show($id){

		$student = Students::find($id);

		$obj = [
			'student' => $student,
			'enrolls' => []
		];

		if($student->enrolls()->count()){
			$obj['enrolls'] = $student->enrolls()->first();
		}

		return view('students.showStudent', $obj);
	}

}