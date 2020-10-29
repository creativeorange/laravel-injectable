<?php

namespace Creativeorange\LaravelInjectable\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Creativeorange\LaravelInjectable\Skeleton\SkeletonClass
 */
class LaravelInjectable extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Creativeorange\LaravelInjectable\LaravelInjectable::class;
    }
}
