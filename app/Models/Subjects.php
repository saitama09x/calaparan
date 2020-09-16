<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Student_records, Student_enrolls};

class Subjects extends Model{

	protected $primaryKey = 'id';
	public $timestamps = false;
    const CREATED_AT = 'date_created';

    protected $fillable = [
        'subjcode', 'subjname', 'gradelevel', 'parent_id', 'date_created'
    ];

    protected $casts = [
        'date_created' => 'date'
    ];

    protected $dates = [
        'date_updated',
    ];

	function records(){
		return $this->hasMany(Student_records::class, 'subjcode', 'subjcode');

	}

	function record(){
		return $this->hasOne(Student_records::class, 'subjcode', 'subjcode');
	}
	
	function scopeParent_subject($query, $id){
		return $query->where('parent_id', $id);
	}

}