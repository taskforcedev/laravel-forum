<?php

namespace Test;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\TestCase as IlluminateTestCase;

class TestCase extends IlluminateTestCase
{
    public function createApplication()
    {
        $app = new Application(
            realpath(__DIR__.'/../')
        );

        return $app;
    }
}