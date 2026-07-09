<?php

declare(strict_types=1);

namespace Paresh27\ModelAuditorLaravel\Concerns;

use Paresh27\ModelAuditorLaravel\Observers\AuditableObserver;

trait Auditable
{
    public static function bootAuditable(): void
    {
        static::created(function ($model) {
            app(AuditableObserver::class)->created($model);
        });

        static::updated(function ($model) {
            app(AuditableObserver::class)->updated($model);
        });

        static::deleted(function ($model) {
            app(AuditableObserver::class)->deleted($model);
        });
    }

// src/Concerns/Auditable.php

public function auditExcluded(): array
{
    return property_exists($this, 'auditExcluded')
        ? $this->auditExcluded
        : ['password', 'remember_token', 'created_at', 'updated_at'];
}

    public function auditSubject(): string
    {
        return static::class.'#'.$this->getKey();
    }
}