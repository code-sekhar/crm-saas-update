<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
     use HasFactory;

    protected $fillable = [
        'tenant_id',
        'assigned_to',
        'title',
        'lead_id',
        'description',
        'due_date',
        'status'
    ];
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'assigned_to'
        );
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
