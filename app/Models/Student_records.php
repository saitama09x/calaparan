<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student_records extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;
    const CREATED_AT = 'datecreated';
}
