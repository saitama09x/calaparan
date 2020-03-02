<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade_subjects extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;
    const CREATED_AT = 'datecreated';
}
