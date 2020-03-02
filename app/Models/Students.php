<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Student_enrolls};

class Students extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;
    const CREATED_AT = 'datecreated';

    function enrolls(){
    	return $this->hasOne(Student_enrolls::class, "student_id", "id");
    }
}
