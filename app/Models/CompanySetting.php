<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    protected $fillable = [

        'tenant_id',

        'company_name',

        'logo',

        'email',

        'phone',

        'website',

        'gst_number',

        'currency',

        'timezone',

        'address'

    ];
}
