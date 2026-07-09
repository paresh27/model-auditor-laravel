<?php

namespace Paresh27\ModelAuditorLaravel\Tests\Fixtures;

use Illuminate\Database\Eloquent\Model;
use Paresh27\ModelAuditorLaravel\Concerns\Auditable;
use Paresh27\ModelAuditorLaravel\Contracts\Auditable as AuditableContract;

class TestPost extends Model implements AuditableContract
{
    use Auditable;

    protected $table = 'test_posts';
    protected $guarded = [];
}