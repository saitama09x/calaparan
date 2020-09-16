<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Grade_sections, Student_enrolls};

class Teachers extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;
    const CREATED_AT = 'datecreated';

    protected $fillable = [
        'section_id'
    ];
    
    function section(){
    	return $this->belongsTo(Grade_sections::class, 'section_id', 'id');
    }

    function subjects(){
    	return $this->hasMany(Grade_subjects::class, 'teacher_id', 'id');
    }

    function scopeGroupyr($query){
    	return $query->select('classgrade')->groupBy("classgrade");
    }

    function enrolls(){
        return $this->hasMany(Student_enrolls::class, 'teacher_id', 'id');
    }

}
