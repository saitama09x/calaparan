<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\{Students, Student_enrolls};
use Illuminate\Routing\UrlGenerator;

class DataTableController extends Controller{

	
	function studentList(Request $r){
		
		$lists = Student_enrolls::all();
		$start = $r->start;
		$length = $r->length;

		$dt = ['draw' => 0, 'recordsTotal' => 0, 'recordsFiltered' => 0, 'data' => []];
		$data = [];
		foreach($lists as $list){
			$data[] = [
				$list->student->fname, 
				$list->student->mname, 
				$list->student->lname, 
				$list->section->sectionname,
				$list->gradeyr,
				"<a href='".route('students.show', $list->student->id)."' class='btn btn-md btn-info'>View</a>"
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