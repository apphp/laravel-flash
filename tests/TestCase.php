<?php

namespace Apphp\Flash\Test;

use Orchestra\Testbench\TestCase as Orchestra;
use Apphp\Flash\FlashServiceProvider;


abstract class TestCase extends Orchestra
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [FlashServiceProvider::class];
    }
}