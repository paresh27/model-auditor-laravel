<?php

namespace Paresh27\ModelAuditorLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class AuditModel extends Model
{
    public $timestamps = false;

    protected $table = 'audits';

    protected $guarded = [];

    protected $casts = [
        'changes' => 'array',
        'occurred_at' => 'datetime',
    ];
}