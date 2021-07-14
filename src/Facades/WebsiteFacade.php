<?php

namespace Adminetic\Website;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Adminetic\Website\Skeleton\SkeletonClass
 */
class WebsiteFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'website';
    }
}
