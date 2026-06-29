<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'email',
        'phone',
        'logo',
        'status'
    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}
