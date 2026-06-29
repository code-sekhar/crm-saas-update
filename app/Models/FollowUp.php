<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    protected $fillable = [
        'tenant_id',
        'lead_id',
        'user_id',
        'follow_up_date',
        'follow_up_time',
        'remarks',
        'priority',
        'status'
    ];
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
