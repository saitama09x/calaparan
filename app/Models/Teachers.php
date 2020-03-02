<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;
    const CREATED_AT = 'datecreated';
}
