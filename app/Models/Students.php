<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Student_enrolls, Student_eligibles, Guest_accounts};

class Students extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;

    const CREATED_AT = 'datecreated';
    const UPDATED_AT = 'dateupdated';

    protected $casts = [
        'datecreated' => 'date',
        'dateupdated' => 'date',
        'bday' => 'date'
    ];

    function getDatecreatedAttribute($value)
    {
        return date("F d, Y", strtotime($value));
    }

     function getBdayAttribute($value)
    {
        return date("F d, Y", strtotime($value));
    }

    function enrolls(){
    	return $this->hasOne(Student_enrolls::class, "student_id", "id");
    }

    function many_enroll(){
    	return $this->hasMany(Student_enrolls::class, "student_id", "id");
    }

    function credentials(){
    	return $this->hasMany(Student_eligibles::class, "student_id", "id");
    }

    function account()
    {
        return $this->morphMany(Guest_accounts::class, 'account');
    }
}
