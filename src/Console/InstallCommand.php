<?php

declare(strict_types=1);

namespace Paresh27\ModelAuditorLaravel\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'model-auditor:install';

    protected $description = 'Publish the Model Auditor config and migration, and optionally run migrations';

    public function handle(): int
    {
        $this->components->info('Installing Model Auditor...');

        $this->call('vendor:publish', [
            '--tag' => 'model-auditor-config',
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'model-auditor-migrations',
        ]);

        if ($this->components->confirm('Run migrations now?', true)) {
            $this->call('migrate');
        }

        $this->components->info('Model Auditor installed.');

        return self::SUCCESS;
    }
}
