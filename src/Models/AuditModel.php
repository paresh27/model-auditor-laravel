<?php

declare(strict_types=1);

namespace Paresh27\ModelAuditorLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $subject
 * @property array<string, array{old: mixed, new: mixed}> $changes
 * @property Carbon $occurred_at
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
