<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Student_values_recs};


class Student_values extends Model{

	protected $primaryKey = 'id';
    public $timestamps = false;

    function values_records(){
    	return $this->hasMany(Student_values_recs::class, 'coreval_id', 'coreval_id');
    }

}