<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Students, Grade_sections, Grade_subjects, Student_records, Student_remarks, Teachers, Schools, Subjects};

class Student_enrolls extends Model{

	protected $primaryKey = 'id';
	public $timestamps = false;
	const CREATED_AT = "datecreated";

	function student(){
		return $this->belongsTo(Students::class, 'student_id', 'id');
	}

/*	function section(){
		return $this->belongsTo(Grade_sections::class, 'section_id', 'id');
	}*/

	function subject_level(){
		return $this->hasMany(Subjects::class, 'gradelevel', 'gradeyr');
	}

	function records(){
		return $this->hasMany(Student_records::class, 'enroll_id', 'id');
	}

	function teacher(){
		return $this->belongsTo(Teachers::class, 'teacher_id', 'id');
	}

	function remarks(){
		return $this->hasMany(Student_remarks::class, 'enroll_id', 'id');
	}

	function school(){
		return $this->belongsTo(Schools::class, 'school_id', 'id');
	}

	function scopeEnrollId($query, $sid, $yr){
		return $query->where([
			['student_id', '=', $sid],
			['gradeyr', '=', $yr]
		]);
	}

	function scopeStudentId($query, $id){
		return $query->where("student_id", $id)->oldest();
	}

	function scopeStudentLevel($query, $id, $level){
		return $query->where([
			["student_id", "=", $id],
			["gradeyr", "=", $level]
		])->oldest();
	}

	function scopeFindteacher($query, $teacher_id){
		return $query->where('teacher_id', '=', $teacher_id);
	}

	function scopeGetlevel($query, $level){
		return $query->where('gradeyr', $level)->latest('yr_from');
	}

	function scopeFindstudenttotal($query, $teacher_id, $yr){
		return $query->where([
			['teacher_id', '=', $teacher_id],
			['yr_from', '=', $yr],
		]);
	}

}