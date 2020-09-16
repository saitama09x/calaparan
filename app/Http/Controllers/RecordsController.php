<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\{Grade_subjects, Students, Student_records, Student_enrolls, Student_remarks, Credentials};

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

	function api_insert_records(Request $r){
		$grade = $r->gradeval;
		$quarter = $r->quarter;
		$sid = $r->sid;
		$yr = $r->grade_yr;
		$enroll = Student_enrolls::enrollId($sid, $yr)->get();

		if($enroll->count()){
			$first = $enroll->first();
			$qtr_col = "qtr_first";
			if($quarter == 2){
				$qtr_col = "qtr_second";
			}
			else if($quarter == 3){
				$qtr_col = "qtr_third";	
			}
			else if($quarter == 4){
				$qtr_col = "qtr_fourth";	
			}
			else if($quarter == 5){
				$qtr_col = "final_rate";
			}
			foreach($grade as $g){
				$json = json_decode($g);
				$records = Student_records::where('enroll_id', $first->id)->where('subjcode', $json->code);
				if(!$records->exists()){
					$data = ['enroll_id' => $first->id, 'subjcode' => $json->code, $qtr_col => $json->value, 'datecreated' => date("Y-m-d", time())];
						Student_records::insert($data);
				}
				else{
					$records->update([
						$qtr_col => $json->value
					]);
				}
			}
		}

		return response()->json($quarter);
	}

	function api_insert_remarks(Request $r){
		$subjcode = $r->subjcode;
		$enroll_id = $r->enroll_id;
		$value = $r->value;

		$find = Student_remarks::where(
			'enroll_id', '=', $enroll_id
		)->where('subjcode', '=', $subjcode);

		if(!$find->exists()){
			$new = new Student_remarks;
			$new->enroll_id = $enroll_id;
			$new->subjcode = $subjcode;
			$new->remarks = $value;
			$new->save();
		}
		else{
			$find->update(
				['remarks' => $value]
			);
		}
		return response("asdas", 200)
                  ->header('Content-Type', 'text/plain');
	}

	function print_report_card($student_id){

		$student = Students::find($student_id);	
		$credentials = Credentials::all();

		$obj = [
			'student' => $student,
			'credential' => $credentials
		];

		return view('records.printRecord', $obj);
	}

}