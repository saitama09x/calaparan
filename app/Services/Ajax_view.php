<?php

namespace App\Services;

class Ajax_view{


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


}