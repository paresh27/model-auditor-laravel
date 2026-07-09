<?php

declare(strict_types=1);

namespace Paresh27\ModelAuditorLaravel\Contracts;

interface Auditable
{
    /**
     * @return array<int, string>
     */
    public function auditExcluded(): array;

    public function auditSubject(): string;
}
