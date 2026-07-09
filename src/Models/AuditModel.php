<?php

namespace Paresh27\ModelAuditorLaravel\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $subject
 * @property array<string, array{old: mixed, new: mixed}> $changes
 * @property \Illuminate\Support\Carbon $occurred_at
 */
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