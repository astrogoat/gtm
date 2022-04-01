<?php

namespace Astrogoat\Gtm\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Astrogoat\Gtm\GoogleTagManager
 */
class GoogleTagManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'googletagmanager';
    }
}
