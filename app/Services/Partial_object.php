<?php

namespace App\Services;

class Partial_object{


	function show_student_record($obj, $student){

		if($student->enrolls()->count()){
			$enrolls = $student->enrolls()->first();
			$obj['enrolls'] = $enrolls;
			$records = $enrolls->records()->get();
			if($records->count()){
				$recdata = [];
				foreach($records as $rec){
					$recdata[$rec->subjcode] = $rec;
				}

				$obj['records'] = $recdata;
			}

			$remarks = $enrolls->remarks()->get();
			if($remarks->count()){
				$rem_arr = [];
				foreach($remarks as $rem){
					$rem_arr[$rem->subjcode] = $rem->remarks;
				}
				$obj['remarks'] = $rem_arr;
			}
		}

		return $obj;

	}


	function show_student_enroll($obj, $enroll){

		if($enroll->student()->count()){
			$obj['student'] = $enroll->student()->first();
		}

		$records = $enroll->records()->get();
		if($records->count()){
			$recdata = [];
			foreach($records as $rec){
				$recdata[$rec->subjcode] = $rec;
			}

			$obj['records'] = $recdata;
		}

		$remarks = $enroll->remarks()->get();
		if($remarks->count()){
			$rem_arr = [];
			foreach($remarks as $rem){
				$rem_arr[$rem->subjcode] = $rem->remarks;
			}
			$obj['remarks'] = $rem_arr;
		}

		return $obj;
	}


}