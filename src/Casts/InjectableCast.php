<?php

namespace Creativeorange\LaravelInjectable\Casts;

use Creativeorange\LaravelInjectable\LaravelInjectable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class InjectableCast implements CastsAttributes
{
    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return Injectable|mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return (new LaravelInjectable())->setBody($value)->setModel($model);
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }
}
