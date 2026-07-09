<?php

declare(strict_types=1);

namespace Paresh27\ModelAuditorLaravel\Observers;

use Illuminate\Database\Eloquent\Model;
use Paresh27\ModelAuditor\Auditor;
use Paresh27\ModelAuditorLaravel\Contracts\Auditable as AuditableContract;

class AuditableObserver
{
    public function __construct(
        private readonly Auditor $auditor,
    ) {}

    public function created(Model&AuditableContract $model): void
    {
        $this->auditor->record(
            subject: $model->auditSubject(),
            old: [],
            new: $this->filtered($model, $model->getAttributes()),
        );
    }

    public function updated(Model&AuditableContract $model): void
    {
        $this->auditor->record(
            subject: $model->auditSubject(),
            old: $this->filtered($model, $model->getOriginal()),
            new: $this->filtered($model, $model->getAttributes()),
        );
    }

    public function deleted(Model&AuditableContract $model): void
    {
        $this->auditor->record(
            subject: $model->auditSubject(),
            old: $this->filtered($model, $model->getOriginal()),
            new: [],
        );
    }

    /**
     * @param  array<string, mixed>  $attributes
     * @return array<string, mixed>
     */
    private function filtered(Model&AuditableContract $model, array $attributes): array
    {
        return array_diff_key($attributes, array_flip($model->auditExcluded()));
    }
}
