<?php

declare(strict_types=1);

namespace Paresh27\ModelAuditorLaravel;

use Illuminate\Support\ServiceProvider;
use Paresh27\ModelAuditor\Auditor;
use Paresh27\ModelAuditor\Storage\InMemoryAuditStorage;
use Paresh27\ModelAuditorLaravel\Console\InstallCommand;

class ModelAuditorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/model-auditor.php',
            'model-auditor',
        );

        $this->app->singleton(Auditor::class, function ($app) {
            return new Auditor(
                storage: $app->make(config('model-auditor.storage', InMemoryAuditStorage::class)),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/model-auditor.php' => config_path('model-auditor.php'),
            ], 'model-auditor-config');

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'model-auditor-migrations');

            $this->commands([
                InstallCommand::class,
            ]);
        }
    }
}
