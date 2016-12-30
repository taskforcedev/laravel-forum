<?php

namespace Test\Unit\Helpers;

use Test\Unit\TestCase;
use Taskforcedev\LaravelForum\Helpers\UserHelper;

class UserHelperTest extends TestCase
{
    public function testUserHelperCanBeInstantiated()
    {
        $helper = new UserHelper();
        $class = get_class($helper);
        $this->assertEquals('Taskforcedev\LaravelForum\Helpers\UserHelper', $class,
            'User helper should return the correct class.');
    }
}