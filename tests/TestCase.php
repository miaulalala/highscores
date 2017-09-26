<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;;
    
    public function setUp()
    {
        parent::setUp();
        Artisan::call('db:seed');
    }
}
