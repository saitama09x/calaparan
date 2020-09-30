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
	Student_eligibles, Student_records, 
	Student_remedials, Student_values, Student_values_recs,
	Subjects
};
use App\Services\Partial_object;
use App\Http\Requests\StudentValidator;

class StudentController extends Controller{
	
	private $partial;
	
	protected $redirectTo = '/dashboard';

	function __construct(Partial_object $partial){
		$this->partial = $partial;
	}

	function index(){

		return view('students.listStudent');

	}

	function store(StudentValidator $r){

		$data = $r->validated();	
		 
		$student = new Students;

		$student->fname = $r->fname;
		$student->lname = $r->lname;
		$student->exname = $r->exname;
		$student->mname = $r->mname;
		$student->bday = strtotime($r->bday);
		$student->sex = $r->sex;
		$student->lrefno = $r->lrefno;
		$student->mother = $r->moname;
		$student->edu_one = $r->edu_one;
		$student->occu_one = $r->occu_one;
		$student->cont_one = $r->cont_one;
		$student->father = $r->faname;
		$student->edu_two = $r->edu_two;
		$student->occu_two = $r->occu_two;
		$student->cont_two = $r->cont_two;
		$student->guardian = $r->guardian;
		$student->edu_three = $r->edu_three;
		$student->occu_three = $r->occu_three;
		$student->cont_three = $r->cont_three;
		$student->datecreated = time();
		$student->dateupdated = time();

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

		if($records->count()){
			$grades_arr = [];
			foreach($records as $r){
				if($r->subject->parent_id == 0){
					$grades_arr[$r->subject->subjcode] = [
						'children' => [],
						'subject' => $r->subject->subjname,
						'subcode' => $r->subject->subjcode,
						'enroll_id' => $r->enroll_id,
						'first' => $r->qtr_first,
						'second' => $r->qtr_second,
						'third' => $r->qtr_third,
						'fourth' => $r->qtr_fourth,
						'final' => $r->final_rate,
						'remarks' => $r->remarks
					];
				}
				else{
					
					$parent = Subjects::where('id', $r->subject->parent_id)->get();

					if($parent->count()){
						$grades_arr[$parent->first()->subjcode]['children'][] = [
							'subject' => $r->subject->subjname,
							'subcode' => $r->subject->subjcode,
							'enroll_id' => $r->enroll_id,
							'first' => $r->qtr_first,
							'second' => $r->qtr_second,
							'third' => $r->qtr_third,
							'fourth' => $r->qtr_fourth,
							'final' => $r->final_rate,
							'remarks' => $r->remarks
						];
					}
				}
			}

		}

		$obj = [
			'student' => [],
			'enrolls' => [],
			'records' => $records,
			'grades' => $grades_arr,
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
					$new->date_from = $remdate_from;
					$new->date_to = $remdate_to;
					$new->save();

				}
				
			}

		}


		return response()->json(['status' => true]);
	}

	function api_remarks_remedial(Request $r){

		$subjcode = $r->subjcode;
		$enroll_id = $r->enroll_id;
		$value = $r->value;

		$status = false;

		$find = Student_remedials::where(
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

	function api_insert_values(Request $r){

		$enroll_id = $r->enroll_id;
		$quarter = $r->quarter;
		$data = $r->data;


		foreach($data as $d){
			
			$update = Student_values_recs::where([
				['enroll_id', '=', $enroll_id],
				['coreval_id', '=', $d['id']]
			]);

			if(!$update->exists()){
				$new = new Student_values_recs;
				$new->enroll_id = $enroll_id;
				$new->coreval_id = $d['id'];

				if($quarter == 1){
					$new->first_qtr = $d['val'];
				}
				
				if($quarter == 2){
					$new->qtr_second = $d['val'];
				}
				
				if($quarter == 3){
					$new->qtr_third = $d['val'];
				}

				if($quarter == 4){
					$new->qtr_fourth = $d['val'];
				}

				$new->date_created = time();
				$new->date_updated = time();

				$new->save();
			}
			else{
				
				$quarter_col = "";

				if($quarter == 1){
					$quarter_col = "first_qtr";
				}
				
				if($quarter == 2){
					$quarter_col = "qtr_second";
				}
				
				if($quarter == 3){
					$quarter_col = "qtr_third";
				}

				if($quarter == 4){
					$quarter_col = "qtr_fourth";
				}

				$update->update([
					$quarter_col => $d['val'],
					'date_updated' => date("Y-m-d", time())
				]);

			}

		}

		return response()->json(['status' => true]);
	}

	function api_qtr_record(Request $r){
		$enroll_id = $r->query('id');
		$qtr = $r->query('qtr');

		$records = Student_records::where('enroll_id', $enroll_id)->get();

		$records_arr = [];
		if($records->count()){
			foreach($records as $rec){
				$grades = 0;
				if($qtr == 1){
					$grades = $rec->qtr_first;
				}
				else if($qtr == 2){
					$grades = $rec->qtr_second;
				}
				else if($qtr == 3){
					$grades = $rec->qtr_third;
				}
				else if($qtr == 4){
					$grades = $rec->qtr_fourth;
				}
				else if($qtr == 5){
					$grades = $rec->final_rate;
				}

				$records_arr[$rec->subjcode] = $grades;
			}

		}

		return response()->json(['status' => true, 'records' => $records_arr]);

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

		$enroll = Student_enrolls::where("id", $enroll_id)->first();
		$remedial = Student_remedials::where("enroll_id", $enroll_id)->get();
		$recordVals = Student_values_recs::where('enroll_id', $enroll_id)->get();
		$corevalues = Student_values::all();

		$recordVal_arr = [];
		if($recordVals->count()){
			foreach($recordVals as $r){
				$recordVal_arr[$r->coreval_id] = [
					'first_qtr' => $r->first_qtr,
					'qtr_second' => $r->qtr_second,
					'qtr_third' => $r->qtr_third,
					'qtr_fourth' => $r->qtr_fourth,
				];
			}
		}

		$core_arr = [];
		if($corevalues->count()){
			foreach($corevalues as $v){
				$values_arr = ['first' => '', 'second' => '', 'third' => '', 'fourth' => ''];
				
				if(isset($recordVal_arr[$v->coreval_id])){
					$values_arr['first'] = $recordVal_arr[$v->coreval_id]['first_qtr'];
					$values_arr['second'] = $recordVal_arr[$v->coreval_id]['qtr_second'];
					$values_arr['third'] = $recordVal_arr[$v->coreval_id]['qtr_third'];
					$values_arr['fourth'] = $recordVal_arr[$v->coreval_id]['qtr_fourth'];
				}

				$core_arr[$v->catval_id]['key'] = $v->catlabel;
				$core_arr[$v->catval_id]['val'][] = ["content" => $v->behavior, "id" => $v->coreval_id, "values" => $values_arr];
			}
		}
		
		

		$obj = [
			'student' => $enroll->student,
			'enrolls' => $enroll,
			'recordVals' => $recordVals,
			'recordVal_arr' => $recordVal_arr,
			'core_arr' => $core_arr,
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
				
				$find_subj = Subjects::all();

				if($find_subj->count()){
					foreach($find_subj as $sub){
						$record = new Student_records;
						$record->enroll_id = $new->id;
						$record->subjcode = $sub->subjcode;
						$record->qtr_first = 0;
						$record->qtr_second = 0;
						$record->qtr_third	 = 0;
						$record->qtr_fourth = 0;
						$record->final_rate = 0;
						$record->datecreated = date("Y-m-d", time());
						$record->save();
					}
				}

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
		
		$remedial_arr = [];
		if($enrolls->count()){
			foreach($enrolls as $e){
				$find = Student_remedials::where("enroll_id", $e->id)->get();
				if($find->count()){
					foreach($find as $f){
						$remedial_arr[$f->enroll_id][] = (object) [
							'subject' => $f->subject->subjname,
							'final_rating' => $f->final_rating,
							'remedial_mark' => $f->remedial_mark,
							'refinal_rating' => $f->refinal_rating,
							'remarks' => $f->remarks,
							'date_from' => $f->date_from,
							'date_to' => $f->date_to
						];
					}
				}
			}
		}

		$obj = [
			'student' => $student,
			'gradeyr' => $gradeyr,
			'credential' => $credentials,
			'school' => $school,
			'enrolls' => $enrolls,
			'remedials' => $remedial_arr
		];

		
		return view('prints.form_137', $obj);

	}

	function print_grade_records($enroll_id){

		$enrolls = Student_records::where('enroll_id', $enroll_id)->get();
		$recordVals = Student_values_recs::where('enroll_id', $enroll_id)->get();
		$remedials = Student_remedials::where("enroll_id", $enroll_id)->get();

		$corevalues = Student_values::all();

		$recordVal_arr = [];
		if($recordVals->count()){
			foreach($recordVals as $r){
				$recordVal_arr[$r->coreval_id] = [
					'first_qtr' => $r->first_qtr,
					'qtr_second' => $r->qtr_second,
					'qtr_third' => $r->qtr_third,
					'qtr_fourth' => $r->qtr_fourth,
				];
			}
		}

		$core_arr = [];
		if($corevalues->count()){
			foreach($corevalues as $v){

				$values_arr = ['first' => '', 'second' => '', 'third' => '', 'fourth' => ''];
				
				if(isset($recordVal_arr[$v->coreval_id])){
					$values_arr['first'] = $recordVal_arr[$v->coreval_id]['first_qtr'];
					$values_arr['second'] = $recordVal_arr[$v->coreval_id]['qtr_second'];
					$values_arr['third'] = $recordVal_arr[$v->coreval_id]['qtr_third'];
					$values_arr['fourth'] = $recordVal_arr[$v->coreval_id]['qtr_fourth'];
				}

				$core_arr[$v->catval_id]['key'] = $v->catlabel;
				$core_arr[$v->catval_id]['val'][] = ["content" => $v->behavior, "id" => $v->coreval_id, "values" => $values_arr];
			}
		}

		$obj = [
			'enrolls' => $enrolls,
			'recordVals' => $recordVals,
			'remedials' => $remedials,
			'core_arr' => $core_arr
		];

		return view('prints.single_records', $obj);
	}

}