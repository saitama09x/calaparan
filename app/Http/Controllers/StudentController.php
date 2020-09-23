<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\{
	Students, Student_enrolls, Teachers, 
	Grade_sections, Credentials, Schools, 
	Student_eligibles, Student_records, Student_remedials
};
use App\Services\Partial_object;

class StudentController extends Controller{
	
	private $partial;
	
	protected $redirectTo = '/dashboard';

	function __construct(Partial_object $partial){
		$this->partial = $partial;
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
		$student->bday = date("Y-m-d", strtotime($r->bday));
		$student->sex = $r->sex;
		$student->datecreated = date("Y-m-d H:i:s", time());
		
		if($student->save()){
			return redirect('/admin/enroll/student/' . $student->id)->with('is_added', true);
		}

	}

	function create(){

		$student = Students::all();

		$obj = [
			'student' => $student
		];

		return view('students.createStudent', $obj);

	}

	function api_show(Request $r){
		$enroll_id = $r->query('id');

		$records = Student_records::where("enroll_id", $enroll_id)->get();

		$obj = [
			'student' => [],
			'enrolls' => [],
			'records' => $records,
			'remarks' => []
		];

		return view('students.dom_showStudent', $obj);
	}

	function api_remedial(Request $r){
		$enroll_id = $r->query('id');

		$remedial = Student_remedials::where("enroll_id", $enroll_id)->get();

		$obj = [
			'student' => [],
			'enrolls' => [],
			'records' => [],
			'remarks' => [],
			'remedial' => $remedial
		];

		return view('students.dom_showRemedial', $obj);
	}

	function api_insert_remedial(Request $r){
		$subjects = json_decode($r->subjects);
		$finalval = $r->finalval;
		$markval = $r->markval;
		$recomval = $r->recomval;
		$remval = $r->remval;
		$enroll_id = $r->enroll_id;
		$remdate_from = $r->remdate_from;
		$remdate_to = $r->remdate_to;

		$del = Student_remedials::where("enroll_id", $enroll_id)->whereNotIn("subjcode", $subjects);
		if($del->exists()){
			$del->delete();	
		}
		
		if(count($subjects)){
			foreach($subjects as $a){
				
				$update = Student_remedials::where([
					[
					'enroll_id', '=', $enroll_id
					],
					[
					'subjcode', '=', $a
					],
				]);

				if($update->exists()){

					$update->update(
						[
							'final_rating' => $finalval[$a],
							'remedial_mark' => $markval[$a],
							'refinal_rating' => $recomval[$a],
							'remarks' => $remval[$a],
							'date_from' => $remdate_from,
							'date_to' => $remdate_to,
						]
					);
				}else{

					$new = new Student_remedials();
					$new->enroll_id = $enroll_id;
					$new->subjcode = $a;
					$new->final_rating = $finalval[$a];
					$new->remedial_mark = $markval[$a];
					$new->refinal_rating = $recomval[$a];
					$new->remarks = $remval[$a];
					$new->date_from = $remdate_from;
					$new->date_to = $remdate_to;
					$new->save();

				}
				
			}

		}


		return response()->json(['status' => true]);
	}


	function show($id){

		$student = Students::find($id);

		$obj = [
			'student' => $student,
			'enrolls' => [],
			'records' => [],
			'remarks' => []
		];
		
		$obj = $this->partial->show_student_record($obj, $student);

		return view('students.showStudent', $obj);
	}

	function grade_record($enroll_id){

		$enroll = Student_enrolls::find($enroll_id)->first();
		$remedial = Student_remedials::where("enroll_id", $enroll_id)->get();

		$obj = [
			'student' => $enroll->student,
			'enrolls' => $enroll,
			'records' => [],
			'remarks' => [],
			'remedial' => $remedial
		];
		
		return view('students.showStudent', $obj);
	}

	function add_eligibities(Request $r){
		$eligibility = $r->eligibility;
		$student_id = $r->student_id;
		$school = $r->school;
		$id = false;

		$delete = Student_eligibles::where('student_id', $student_id);
		
		if($delete->exists()){
			$delete->delete();
		}

		foreach($eligibility as $e){
			$id = Student_eligibles::insertGetId(['student_id' => $student_id, 'eligible_id' => $e, 'school_id' => $school]);
		}

		if($id){
			return redirect('/admin/enroll/student/' . $student_id);
		}
	}

	function grade_enroll($student_id){

		$student = Students::find($student_id);	
		$gradeyr = Teachers::groupyr()->get();
		$credentials = Credentials::all();
		$school = Schools::all();

		$adviser = [];

		foreach($gradeyr as $yr){
			$adviser[$yr->classgrade] = ['enroll_id' => '', 'yr_from' => '', 'yr_to' => '', 'data' => []];
			$lists = Teachers::where('classgrade', '=', $yr->classgrade)->get();
			if($lists->count()){
				foreach($lists as $l){
					$section = $l->section();
					$secname = "No Section";
					if($section->exists()){
						$secname = $section->first()->sectionname;
					}

					$is_select = false;
					$total_student = 0;
					$enroll_id = null;
					$enroll = $student->enrolls()->findteacher($l->id);
					if($enroll->exists()){
						$is_select = true;
						$total_student = $enroll->count();
					}

					if($is_select){
						$adviser[$yr->classgrade]['yr_from'] = $enroll->first()->yr_from;
						$adviser[$yr->classgrade]['yr_to'] = $enroll->first()->yr_to;
						$adviser[$yr->classgrade]['enroll_id'] = $enroll->first()->id;
					}
					
					$adviser[$yr->classgrade]['data'][] = (object)[
						'id' => $l->id,
						'name' => $l->fullname,
						'section' => $secname,
						'total_student' => $total_student,
						'is_selected' => $is_select
					];
				}
			}
			
		}

		$obj = [
			'student' => $student,
			'gradeyr' => $gradeyr,
			'adviser' => $adviser,
			'credential' => $credentials,
			'school' => $school
		];

		
		return view('students.grade_enroll', $obj);
		
	}

	function grade_enroll_add(Request $r){
		$gradeyr = $r->gradeyr;
		$teacher_id = $r->teacher_id;
		$id = $r->student_id;
		$yr_from = date("Y-m-d", strtotime($r->year_from));
		$yr_to = date("Y-m-d", strtotime($r->year_to));

		$find_enroll = Student_enrolls::where('student_id', '=', $id)->where('gradeyr', '=', $gradeyr);
		$eligible = Student_eligibles::where('student_id', $id)->get();

		if(!$find_enroll->exists()){
			$new = new Student_enrolls;
			$new->student_id = $id;
			$new->teacher_id = $teacher_id;
			$new->gradeyr = $gradeyr;
			$new->yr_from = $yr_from;
			$new->yr_to = $yr_to;
			$new->school_id = $eligible->first()->school_id;
			$new->datecreated = date("Y-m-d", time());
			if($new->save()){
				if(Auth::guard('web')->check()){
					return redirect()->route('grade-enroll', ['id' => $id] );
				}
				else
				{
					return redirect()->route('admin-student-enroll', ['id' => $id]);
				}
			}
		}
		else{
			$update = $find_enroll->update([
				"teacher_id" => $teacher_id,
				"gradeyr" => $gradeyr,
				"yr_from" => $yr_from,
				"yr_to" => $yr_to
			]);

			if($update){
				if(Auth::guard('web')->check()){
					return redirect()->route('grade-enroll', ['id' => $id] );
				}
				else
				{
					return redirect()->route('admin-student-enroll', ['id' => $id]);
				}
			}
		}
		
	}

	function print_form_137($student_id){

		$student = Students::find($student_id);	
		$gradeyr = Teachers::groupyr()->get();
		$credentials = Credentials::all();
		$school = Schools::all();
		$enrolls = Student_enrolls::studentId($student_id)->get();

		$obj = [
			'student' => $student,
			'gradeyr' => $gradeyr,
			'credential' => $credentials,
			'school' => $school,
			'enrolls' => $enrolls
		];

		
		return view('prints.form_137', $obj);

	}

}