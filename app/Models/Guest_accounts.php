<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Guest_accounts extends Authenticatable{

	use Notifiable;

	protected $table = 'guest_accounts';
	const CREATED_AT = 'date_created';
	const UPDATED_AT = 'date_updated';

	protected $fillable = [
        'username', 'account_type', 'acct_type_id', 'password', 'date_created', 'date_updated'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'date_created' => 'date',
        'date_updated' => 'date'
    ];

    public function account()
    {
        return $this->morphTo();
    }
}