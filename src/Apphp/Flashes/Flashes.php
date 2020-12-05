<?php

namespace Apphp\Flashes;

use Illuminate\Support\Facades\Facade;


class Flashes extends Facade
{
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'flashes';
    }
}