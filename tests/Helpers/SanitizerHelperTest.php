<?php

namespace Test\Helpers;

use Test\TestCase;
use Taskforcedev\LaravelForum\Helpers\Sanitizer as SanitizerHelper;

class SanitizerHelperTest extends TestCase
{
    public function testSanitizerHelperCanBeInstantiated()
    {
        $helper = new SanitizerHelper();
        $class = get_class($helper);
        $this->assertEquals('Taskforcedev\LaravelForum\Helpers\Sanitizer', $class, 'Sanitizer helper should return the correct class.');
    }
}