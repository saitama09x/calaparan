<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Students, Schools};


class Student_eligibles extends Model{

	protected $primaryKey = 'id';
	public $timestamps = false;
	

	function school(){
		return $this->belongsTo(Schools::class, "school_id", "id");
	}

}