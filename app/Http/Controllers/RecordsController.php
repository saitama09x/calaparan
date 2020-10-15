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
		$enroll_id = $r->enroll_id;
		$enroll = Student_enrolls::where("id", $enroll_id)->get();

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
					if(!empty($json->value)){
						$data = ['enroll_id' => $first->id, 'subjcode' => $json->code, $qtr_col => $json->value, 'datecreated' => date("Y-m-d", time())];
						Student_records::insert($data);
					}
				}
				else{
					if(!empty($json->value)){
						$records->update([
							$qtr_col => $json->value
						]);
					}
				}
			}
		}

		return response()->json($quarter);
	}

	function api_insert_remarks(Request $r){

		$subjcode = $r->subjcode;
		$enroll_id = $r->enroll_id;
		$value = $r->value;

		$status = false;

		$find = Student_records::where(
			'enroll_id', '=', $enroll_id
		)->where('subjcode', '=', $subjcode);

		if($find->exists()){
			$find->update(
				['remarks' => $value]
			);

			$status = true;
		}

		return response()->json(['status' => $status]);
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