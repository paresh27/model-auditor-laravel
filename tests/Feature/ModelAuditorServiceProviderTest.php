<?php

use Paresh27\ModelAuditor\Auditor;

it('resolves the auditor from the container', function () {
    $auditor = $this->app->make(Auditor::class);

    expect($auditor)->toBeInstanceOf(Auditor::class);
});

it('resolves the auditor as a singleton', function () {
    $first = $this->app->make(Auditor::class);
    $second = $this->app->make(Auditor::class);

    expect($first)->toBe($second);
});

it('loads the default config', function () {
    expect(config('model-auditor.storage'))
        // ->toBe(\Paresh27\ModelAuditor\Storage\InMemoryAuditStorage::class);
         ->toBe(\Paresh27\ModelAuditorLaravel\Storage\EloquentAuditStorage::class);
});