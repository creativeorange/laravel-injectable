<?php

namespace Creativeorange\LaravelInjectable;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Creativeorange\LaravelInjectable\Skeleton\SkeletonClass
 */
class LaravelInjectableFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return LaravelInjectable::class;
    }
}
