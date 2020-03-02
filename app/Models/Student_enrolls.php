<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Students, Grade_sections, Grade_subjects};

class Student_enrolls extends Model{

	protected $primaryKey = 'id';
	public $timestamps = false;


	function student(){
		return $this->belongsTo(Students::class, 'student_id', 'id');
	}

	function section(){
		return $this->belongsTo(Grade_sections::class, 'section_id', 'id');
	}

}