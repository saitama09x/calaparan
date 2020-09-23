<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Students, Teachers, Subjects};

class Student_remedials extends Model{

	const CREATED_AT = 'date_created';
	const UPDATED_AT = 'date_updated';

	protected $casts = [
        'date_created' => 'date',
        'date_updated' => 'date'
    ];

    function subject(){
    	return $this->belongsTo(Subjects::class, 'subjcode', 'subjcode');
    }

}