<?php

use Paresh27\ModelAuditorLaravel\Storage\EloquentAuditStorage;

return [
    /*
     * The storage implementation used to persist audit records.
     * Must implement Paresh27\ModelAuditor\Contracts\AuditStorage.
     *
     * Built-in options:
     * - Paresh27\ModelAuditor\Storage\InMemoryAuditStorage (default, no persistence)
     * - Paresh27\ModelAuditorLaravel\Storage\EloquentAuditStorage (persists to the `audits` table)
     */
    'storage' => EloquentAuditStorage::class,
];