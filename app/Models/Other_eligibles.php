<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Students, Schools};

class Other_eligibles extends Model{

	protected $primaryKey = 'id';
	public $timestamps = false;
	

	function student(){
		return $this->belongsTo(Students::class, "student_id", "id");
	}

}