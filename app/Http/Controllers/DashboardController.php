<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\{Students, Student_enrolls, Student_records, Student_remarks};
use App\Services\School_class;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller{

	function __construct(){


	}

	function index(){

		$student = Students::all();

		$obj = [
			'student' => $student
		];
	

		return view('dashboard.dashboard', $obj);
	}


	function dashboard_student_records(){

		$student = Students::find(1);

		$obj = [
			'student' => [],
			'enrolls' => [],
			'records' => []
		];

		$teacher_name = "";
		$section_name = "";
		if($student->count()){
			$obj['student'] = $student;
			$enroll = $student->many_enroll();
			if($enroll->exists()){
				$res = $enroll->get();
				foreach($res as $r){
					$teacher = $r->teacher();
					if($teacher->exists()){
						$section = $teacher->first()->section();
						if($section->exists()){
							$teacher = $teacher->first();
							$section = $section->first();
							$teacher_name = $teacher->fullname;
							$section_name = $section->sectionname;
						}

						$school = $r->school();
						$school_class = new School_class;
						if($school->exists()){
							$school_class->set_school($school->first());
						}
					}
					$obj['enrolls'][] = (object) [ 
						'id' => $r->id,
						'teacher' => $teacher_name, 
						'section' => $section_name, 
						'gradeyr' => $r->gradeyr, 
						'yr_from' => $r->yr_from, 'yr_to' => $r->yr_to,
						'shname' => $school_class->get_name(),
						'shid' =>  $school_class->get_id(),
						'district' => $school_class->get_district(),
						'division' => $school_class->get_division(),
						'region' => $school_class->get_region()
						];
				}
			}
		}

		if(count($obj['enrolls']) > 0){
			$enrolls = $obj['enrolls'];
			foreach($enrolls as $e){
				$rec = Student_records::where('enroll_id', $e->id);
				if($rec->exists()){
					$rec = $rec->get();
					foreach($rec as $r){
						$sub = $r->subject();
						$subname = "";
						$remarks = "";
						if($sub->exists()){
							$rem = Student_remarks::subjectRem($e->id, $sub->first()->subjcode);
							if($rem->exists()){
								$remarks = $rem->first()->remarks;
							}
							$subname = $sub->first()->subjname;
						}
						$obj['records'][] = (object) [ 'id' => $r->enroll_id, 
							'subname' => $subname, 
							'qtr_first' => $r->qtr_first, 
							'qtr_second' => $r->qtr_second, 
							'qtr_third' => $r->qtr_third, 
							'qtr_fourth' => $r->qtr_fourth, 
							'final_rate' => $r->final_rate,
							'remarks' => $remarks
						];
					}
				}
			}
		}

		return view('dashboard.student_records', $obj);

	}


}