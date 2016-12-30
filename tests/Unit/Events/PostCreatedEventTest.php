<?php

namespace Test\Unit\Events;

use Test\Unit\TestCase;
use Taskforcedev\LaravelForum\Models\ForumPost;
use Taskforcedev\LaravelForum\Events\PostCreated;

class PostCreatedEventTest extends TestCase
{
    protected $event;

    public function setUp()
    {
        $post = new ForumPost();
        $post->id = 1;
        $user = 'Test';
        $this->event = new PostCreated($post, $user);
    }

    public function testEventCanBeInstantiated()
    {
        $class = get_class($this->event);
        $this->assertEquals('Taskforcedev\LaravelForum\Events\PostCreated', $class,
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