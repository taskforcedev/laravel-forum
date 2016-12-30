<?php

namespace Test\Unit\Helpers;

use Test\Unit\TestCase;
use Taskforcedev\LaravelForum\Helpers\Sanitizer as SanitizerHelper;

class SanitizerHelperTest extends TestCase
{
    public function testSanitizerHelperCanBeInstantiated()
    {
        $helper = new SanitizerHelper();
        $class = get_class($helper);
        $this->assertEquals('Taskforcedev\LaravelForum\Helpers\Sanitizer', $class,
            'Sanitizer helper should return the correct class.');
    }

    public function testSanitizerRemovesScriptTagsFromAHtmlString()
    {
        $helper = new SanitizerHelper();
        $html = '<!DOCTYPE html><html><head></head><body><h1>This is my test page</h1><script>alert(\'hello\');</script></body></html>';

        $output = $helper->sanitize($html);

        $this->assertRegExp('/script/', $html, 'HTML string given does regexp match script tag.');
        $this->assertNotRegExp('/script/', $output, 'Output should not match script tags.');
    }
}