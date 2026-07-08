<?php

namespace Paresh27\ModelAuditorLaravel\Concerns;

use Paresh27\ModelAuditorLaravel\Observers\AuditableObserver;

trait Auditable
{
    public static function bootAuditable(): void
    {
        static::observe(AuditableObserver::class);
    }

    /**
     * Fields to exclude from auditing (e.g. passwords, tokens).
     * Consumers can override this on their model.
     */
    public function auditExcluded(): array
    {
        return property_exists($this, 'auditExcluded')
            ? $this->auditExcluded
            : ['password', 'remember_token'];
    }

    /**
     * A human-readable subject identifier for this model instance,
     * e.g. "App\Models\User#42".
     */
    public function auditSubject(): string
    {
        return static::class.'#'.$this->getKey();
    }
}