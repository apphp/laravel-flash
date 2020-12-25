<?php

namespace Apphp\Flash\Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Apphp\Flash\FlashServiceProvider;


abstract class TestCase extends BaseTestCase
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