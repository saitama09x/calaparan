<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\{Grade_subjects, Students, Student_records};

class RecordsController extends Controller{


	function index(){

		$student = Students::all();

	}

	function edit($student_id){

		$records = Student_records::all();
		$subject = Grade_subjects::all();
		$student = Students::find($student_id);

		$obj = [
			'records' => $records,
			'subject' => $subject,
			'student' => $student
		];

		return view('records.editRecords', $obj);
	}

	function update()
}