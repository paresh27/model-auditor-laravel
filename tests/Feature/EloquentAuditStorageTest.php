// tests/Feature/EloquentAuditStorageTest.php
<?php

use Paresh27\ModelAuditor\AuditRecord;
use Paresh27\ModelAuditorLaravel\Storage\EloquentAuditStorage;

it('persists a record and reads it back', function () {
    $storage = new EloquentAuditStorage();

    $record = new AuditRecord(
        subject: 'TestPost#1',
        changes: ['title' => ['old' => 'A', 'new' => 'B']],
        occurredAt: new DateTimeImmutable('2026-01-01T12:00:00+00:00'),
    );

    $storage->store($record);

    $all = $storage->all();

    expect($all)->toHaveCount(1);
    expect($all[0]->subject)->toBe('TestPost#1');
    expect($all[0]->changes)->toBe(['title' => ['old' => 'A', 'new' => 'B']]);
    expect($all[0]->occurredAt)->toBeInstanceOf(DateTimeImmutable::class);
});