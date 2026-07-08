<?php

namespace Paresh27\ModelAuditorLaravel\Tests\Fixtures;

use Illuminate\Database\Eloquent\Model;
use Paresh27\ModelAuditorLaravel\Concerns\Auditable;

class TestPost extends Model
{
    use Auditable;

    protected $table = 'test_posts';
    protected $guarded = [];
    public $timestamps = false;
}