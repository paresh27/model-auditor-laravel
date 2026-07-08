// tests/Feature/AuditableTest.php
<?php

use Paresh27\ModelAuditor\Auditor;
use Paresh27\ModelAuditorLaravel\Tests\Fixtures\TestPost;

it('records an audit entry when a model is created', function () {
    $post = TestPost::create([
        'title' => 'Hello World',
        'password' => 'secret',
    ]);

    $auditor = $this->app->make(Auditor::class);
    $history = $auditor->history();

    expect($history)->toHaveCount(1);
    expect($history[0]->subject)->toBe(TestPost::class.'#'.$post->id);
    expect($history[0]->changes)->toHaveKey('title');
    expect($history[0]->changes)->not->toHaveKey('password');
});

it('records an audit entry when a model is updated', function () {
    $post = TestPost::create(['title' => 'Original']);

    $post->update(['title' => 'Updated']);

    $auditor = $this->app->make(Auditor::class);
    $history = $auditor->history();

    // one for create, one for update
    expect($history)->toHaveCount(2);

    $updateRecord = $history[1];

    expect($updateRecord->changes)->toBe([
        'title' => ['old' => 'Original', 'new' => 'Updated'],
    ]);
});

it('records an audit entry when a model is deleted', function () {
    $post = TestPost::create(['title' => 'Going away']);

    $post->delete();

    $auditor = $this->app->make(Auditor::class);
    $history = $auditor->history();

    expect($history)->toHaveCount(2); // create + delete

    $deleteRecord = $history[1];

    expect($deleteRecord->changes)->toHaveKey('title');
    expect($deleteRecord->changes['title']['new'])->toBeNull();
});

it('does not record anything when nothing actually changed', function () {
    $post = TestPost::create(['title' => 'Same']);

    $post->update(['title' => 'Same']); // no real change

    $auditor = $this->app->make(Auditor::class);

    expect($auditor->history())->toHaveCount(1); // only the create
});