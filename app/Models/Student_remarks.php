<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Students};


class Student_remarks extends Model{

	protected $primaryKey = 'id';
	public $timestamps = false;

	function scopeSubjectRem($query, $enroll_id, $subcode){
		return $query->where([
    		['enroll_id', '=', $enroll_id],
    		['subjcode', '=', $subcode]
    	]);
	}
}