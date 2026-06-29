<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [

        'tenant_id',

        'user_id',

        'module',

        'action',

        'record_id',

        'description',

        'ip_address',

        'browser',

        'platform',

        'old_values',

        'new_values',

    ];

    protected $casts = [

        'old_values' => 'array',

        'new_values' => 'array',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeModule($query, $module)
    {
        return $query->where('module', $module);
    }

    public function scopeAction($query, $action)
    {
        return $query->where('action', $action);
    }

    public function scopeTenant($query)
    {
        if (auth()->check()) {

            return $query->where(
                'tenant_id',
                auth()->user()->tenant_id
            );

        }

        return $query;
    }
}
