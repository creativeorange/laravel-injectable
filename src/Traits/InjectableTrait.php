<?php

namespace Creativeorange\LaravelInjectable\Traits;

trait InjectableTrait
{
    public $injectedAttributes = [];

    /**
     * Inject a variable to this model so this will be used in @param $attribute
     *
     * @param $value
     * @return $this
     * @see InjectableCast fields
     */
    public function inject($attribute, $value)
    {
        if (is_array($attribute)) {
            foreach ($attribute as $key => $value) {
                $this->inject($key, $value);
            }
            return $this;
        }

        $this->injectedAttributes[$attribute] = $value;

        return $this;
    }
}
