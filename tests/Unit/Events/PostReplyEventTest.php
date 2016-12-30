<?php

namespace Test\Unit\Events;

use Test\Unit\TestCase;
use Taskforcedev\LaravelForum\Models\ForumReply;
use Taskforcedev\LaravelForum\Events\PostReply;

class PostReplyEventTest extends TestCase
{
    protected $event;

    public function setUp()
    {
        $post = new ForumReply();
        $post->id = 1;
        $user = 'Test';
        $this->event = new PostReply($post, $user);
    }

    public function testEventCanBeInstantiated()
    {
        $class = get_class($this->event);
        $this->assertEquals('Taskforcedev\LaravelForum\Events\PostReply', $class,
            'Event should be of the correct class.');
    }

    public function testEventPublishesOnTheCorrectChannel()
    {
        $event = $this->event;
        $broadcast = $event->broadcastOn();
        $channels = array_values($broadcast);
        $this->assertEquals('laravel-forum', $channels[0]);
    }
}