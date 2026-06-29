<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoginActivity extends Model
{
    use HasFactory;

    protected $fillable = [

        'tenant_id',

        'user_id',

        'ip_address',

        'browser',

        'platform',

        'device',

        'country',

        'city',

        'login_at',

        'logout_at'

    ];

    protected $casts = [

        'login_at' => 'datetime',

        'logout_at' => 'datetime',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
