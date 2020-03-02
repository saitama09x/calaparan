<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Students};


class Grade_sections extends Model{

	protected $primaryKey = 'id';

	function subjects(){
		return $this->hasMany(Grade_subjects::class, 'teacher_id', 'teacher_id');
	}

}