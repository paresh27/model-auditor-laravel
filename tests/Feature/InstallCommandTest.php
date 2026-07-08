<?php

it('publishes config and migration, and runs migrations when confirmed', function () {
    $this->artisan('model-auditor:install')
        ->expectsConfirmation('Run migrations now?', 'yes')
        ->assertSuccessful();

    expect(file_exists(config_path('model-auditor.php')))->toBeTrue();
    expect(glob(database_path('migrations/*_create_audits_table.php')))->not->toBeEmpty();
});