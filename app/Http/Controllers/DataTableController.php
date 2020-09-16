<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\{Students, Student_enrolls, Teachers};
use Illuminate\Routing\UrlGenerator;

class DataTableController extends Controller{

	
	function studentList(Request $r){
		
		$lists = Students::all();
		$start = $r->start;
		$length = $r->length;

		$dt = ['draw' => 0, 'recordsTotal' => 0, 'recordsFiltered' => 0, 'data' => []];
		$data = [];
		foreach($lists as $list){
			$enrolls = $list->many_enroll()->get();
			$enroll = Student_enrolls::studentId($list->id);
			$enroll_data = [];
			if($enrolls->count()){
				foreach($enrolls as $e){
					$section = "";
					if($e->teacher()->exists()){
						if($e->teacher()->first()->section()->exists()){
							$section = $e->teacher()->first()->section()->first()->sectionname;
						}
					}
					$enroll_data[] = [
						'enroll_id' => $e->id,
						'student_id' => $e->student_id,
						'yr_from' => $e->yr_from,
						'yr_to' => $e->yr_to,
						'section' => $section,
						'gradeyr' => $e->gradeyr,
						'url' => route('admin-student-record', $e->id)
					];
				}
			}

			$section = "";
			$gradeyr = "";
			if($enroll->exists()){
				$enroll = $enroll->first();
				$gradeyr = $enroll->gradeyr;
				$teacher = Teachers::find($enroll->teacher_id);
				if($teacher->exists()){
					$section = $teacher->section()->first()->sectionname;
				}
			}

			$data[] = [
				"first_name" => $list->fname, 
				"middle_name" => $list->mname, 
				"last_name" => $list->lname, 
				"section" => $section,
				"gradeyr" => $gradeyr,
				"enrolls" => $enroll_data,
				"action" => "<button type='button' class='btn btn-sm btn-primary show-detail'>Show Record</button>&nbsp;<a href='".route('admin-student-enroll', $list->id)."' class='btn btn-sm btn-info'>Enrollment</a>"
			];
		}

		$dt['recordsTotal'] = count($data);
		$splice = array_splice($data, 0, 10);
		$dt['recordsFiltered'] = count($splice);
		$dt['data'] = $splice;

		return response()->json($dt);
	}

}

?>