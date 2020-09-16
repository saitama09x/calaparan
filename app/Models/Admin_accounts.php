<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin_accounts extends Authenticatable{

	use Notifiable;

	protected $table = 'admin_accounts';
    protected $guard = 'admin';

	const CREATED_AT = 'date_created';
	const UPDATED_AT = 'date_updated';

	protected $fillable = [
        'username', 'password', 'fname', 'mname', 'lname', 'date_created', 'date_updated'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'date_created' => 'date',
        'date_updated' => 'date'
    ];
}