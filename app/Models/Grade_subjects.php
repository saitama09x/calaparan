<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Subjects};

class Grade_subjects extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;
    const CREATED_AT = 'datecreated';

    function subjects(){
    	return $this->belongsTo(Subjects::class, 'subjcode', 'subjcode');
    }
}
