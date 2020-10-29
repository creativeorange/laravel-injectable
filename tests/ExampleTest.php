<?php

namespace Creativeorange\LaravelInjectable\Tests;

use Creativeorange\LaravelInjectable\LaravelInjectableServiceProvider;
use Orchestra\Testbench\TestCase;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [LaravelInjectableServiceProvider::class];
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
