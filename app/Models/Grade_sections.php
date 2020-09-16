<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Students, Teachers};


class Grade_sections extends Model{

	protected $primaryKey = 'id';
	public $timestamps = false;
    const CREATED_AT = 'date_created';

    protected $fillable = [
        'sectionname', 'gradelevel', 'date_updated'
    ];

    protected $dates = [
        'date_updated',
    ];

     protected $casts = [
        'date_created' => 'date'
    ];

	function student_subjects(){
		return $this->hasMany(Grade_subjects::class, 'teacher_id', 'teacher_id');
	}

	function adviser(){
		return $this->hasOne(Teachers::class, 'section_id', 'id');
	}


}