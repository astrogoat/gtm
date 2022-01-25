<?php

namespace Astrogoat\Gtm;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Astrogoat\Gtm\Gtm
 */
class GtmFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'gtm';
    }
}
