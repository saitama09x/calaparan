<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Subjects};

class Student_records extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;
    const CREATED_AT = 'datecreated';


    function subject(){
    	return $this->belongsTo(Subjects::class, 'subjcode', 'subjcode');
    }

    function scopeStudentRec($query, $enroll_id, $subcode){
    	return $query->where([
    		['enroll_id', '=', $enroll_id],
    		['subjcode', '=', $subcode]
    	]);
    }

}
