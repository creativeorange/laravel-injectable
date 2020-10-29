<?php

namespace Creativeorange\LaravelInjectable;

use Creativeorange\LaravelInjectable\Traits\InjectableTrait;
use Illuminate\Database\Eloquent\Model;

class LaravelInjectable
{
    /**
     * Attributes that can be set on application level
     * @see set
     * @var array
     */
    private static $staticAttributes = [];

    /**
     * The body of the injectable containing the original string
     *
     * @var array
     */
    private $body = '';

    /**
     * @var Model|null
     */
    private $model;

    /**
     * Attributes that can be set on this specific instance
     * @see inject
     * @var array
     */
    private $attributes = [];

    /**
     * Injectable constructor.
     */
    public function __construct()
    {
    }

    /**
     * Set the body
     *
     * @param $body
     * @return $this
     */
    public function setBody($body): LaravelInjectable
    {
        $this->body = $body;
        return $this;
    }

    /**
     * Set the model
     *
     * @param  Model  $model
     * @return $this
     */
    public function setModel(Model $model): LaravelInjectable
    {
        $this->model = $model;
        return $this;
    }

    /**
     * Inject a variable in all instances
     *
     * @param $attribute
     * @param $value
     * @return LaravelInjectable
     */
    public function set($attribute, $value = null): LaravelInjectable
    {
        if (is_array($attribute)) {
            foreach ($attribute as $k => $v) {
                self::set($k, $v);
            }
        } else {
            self::$staticAttributes[$attribute] = $value;
        }

        return $this;
    }

    /**
     * When this injectable is treated as a string, translate the message using the static and non static attributes
     * @return string
     */
    public function __toString(): string
    {
        return __($this->body, $this->getAllInjectables());
    }

    /**
     * Retreive all injectables that were set for this instance
     *
     * @return array
     */
    public function getAllInjectables(): array
    {
        return array_merge($this->getStaticAttributes(), $this->getModelAttributes(), $this->getAttributes());
    }

    /**
     * @return array
     */
    public function getStaticAttributes(): array
    {
        return self::$staticAttributes;
    }

    /**
     * @return array
     */
    public function getModelAttributes(): array
    {
        if (!$this->model || !$this->model instanceof Model || !in_array(InjectableTrait::class,
                class_uses($this->model))) {
            return [];
        }

        /** @var InjectableTrait $model */
        $model = $this->model;

        return $model->injectedAttributes;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Inject a variable in this instance
     *
     * @param  array|string  $attribute
     * @param $value
     * @return LaravelInjectable
     */
    public function inject($attribute, $value = null): LaravelInjectable
    {
        if (is_array($attribute)) {
            foreach ($attribute as $key => $value) {
                $this->inject($key, $value);
            }
            return $this;
        }

        $this->attributes[$attribute] = $value;

        return $this;
    }
}
