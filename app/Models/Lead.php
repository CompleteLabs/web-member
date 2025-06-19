<?php

namespace App\Models;

use Apriansyahrs\CustomFields\Models\Concerns\UsesCustomFields;
use Apriansyahrs\CustomFields\Models\Contracts\HasCustomFields;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model implements HasCustomFields
{
    use SoftDeletes, UsesCustomFields;

    protected $fillable = [
        'name',
        'phone',
        'address',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
}
