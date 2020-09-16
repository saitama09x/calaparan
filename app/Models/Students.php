<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Student_enrolls, Student_eligibles};

class Students extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;
    const CREATED_AT = 'datecreated';

    function enrolls(){
    	return $this->hasOne(Student_enrolls::class, "student_id", "id");
    }


    function many_enroll(){
    	return $this->hasMany(Student_enrolls::class, "student_id", "id");
    }

    function credentials(){
    	return $this->hasMany(Student_eligibles::class, "student_id", "id");
    }
}
