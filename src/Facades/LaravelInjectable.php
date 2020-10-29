<?php

namespace Creativeorange\LaravelInjectable\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Creativeorange\LaravelInjectable\LaravelInjectable setModel(\Illuminate\Database\Eloquent\Model $model)
 * @method static \Creativeorange\LaravelInjectable\LaravelInjectable setBody($body)
 * @method static \Creativeorange\LaravelInjectable\LaravelInjectable set(string|array $attribute, string|null $value)
 * @method static array getAllInjectables()
 * @method static array getStaticAttributes()
 * @method static array getModelAttributes()
 * @method static array getAttributes()
 * @method static \Creativeorange\LaravelInjectable\LaravelInjectable inject(string|array $attribute, string|null $value)
 * @method static bool exists(string $email)
 *
 * @see \Creativeorange\LaravelInjectable\LaravelInjectable
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
