<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Student_values};

class Student_values_recs extends Model{

	protected $primaryKey = 'id';
    public $timestamps = false;
    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    protected $casts = [
        'date_created' => 'date',
        'date_updated' => 'date',
    ];

    function student_values(){
    	return $this->belongsTo(Student_values::class, 'coreval_id', 'coreval_id');
    }
}