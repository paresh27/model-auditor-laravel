<?php

namespace Paresh27\ModelAuditorLaravel\Observers;

use Illuminate\Database\Eloquent\Model;
use Paresh27\ModelAuditor\Auditor;

class AuditableObserver
{
    public function __construct(
        private readonly Auditor $auditor,
    ) {
    }

    public function created(Model $model): void
    {
        $this->auditor->record(
            subject: $model->auditSubject(),
            old: [],
            new: $this->filtered($model, $model->getAttributes()),
        );
    }


public function updated(Model $model): void
{
    $this->auditor->record(
        subject: $model->auditSubject(),
        old: $this->filtered($model, $model->getOriginal()),
        new: $this->filtered($model, $model->getAttributes()),
    );
}

    public function deleted(Model $model): void
    {
        $this->auditor->record(
            subject: $model->auditSubject(),
            old: $this->filtered($model, $model->getOriginal()),
            new: [],
        );
    }

    private function filtered(Model $model, array $attributes): array
    {
        return array_diff_key($attributes, array_flip($model->auditExcluded()));
    }
}