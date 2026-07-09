<?php

declare(strict_types=1);

namespace Paresh27\ModelAuditorLaravel\Storage;

use DateTimeImmutable;
use Paresh27\ModelAuditor\AuditRecord;
use Paresh27\ModelAuditor\Contracts\AuditStorage;
use Paresh27\ModelAuditorLaravel\Models\AuditModel;

class EloquentAuditStorage implements AuditStorage
{
    public function store(AuditRecord $record): void
    {
        AuditModel::create([
            'subject' => $record->subject,
            'changes' => $record->changes,
            'occurred_at' => $record->occurredAt,
        ]);
    }

    /**
     * @return array<int, AuditRecord>
     */
    public function all(): array
    {
        return AuditModel::query()
            ->orderBy('id')
            ->get()
            ->map(fn (AuditModel $row) => new AuditRecord(
                subject: $row->subject,
                changes: $row->changes,
                occurredAt: DateTimeImmutable::createFromInterface($row->occurred_at),
            ))
            ->all();
    }
}
