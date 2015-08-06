<?php namespace Taskforcedev\LaravelForum\Http\Controllers;

use \Auth;
use \Event;
use \Request;
use \Response;
use \Schema;
use Taskforcedev\LaravelForum\Forum;
use Taskforcedev\LaravelForum\ForumCategory;
use Taskforcedev\LaravelForum\ForumPost;
use Taskforcedev\LaravelForum\ForumReply;
use Taskforcedev\LaravelForum\Events\PostCreated;
use Taskforcedev\LaravelForum\Events\PostReply;

/**
 * Class ApiController
 * @package Taskforcedev\LaravelForum\Http\Controllers
 */
class ApiController extends BaseController
{
    public function forumCategoryStore()
    {
        $data = [
            "name" => Request::input('name'),
        ];

        $response = $this->adminCheck();
        if (isset($response)) {
            return $response;
        }

        /* If data invalid return bad request */
        if (!ForumCategory::valid($data)) {
            return Response::make('Bad Request', 400);
        }

        ForumCategory::create($data);
    }

    public function forumStore()
    {
        $data = [
            "name" => Request::input('name'),
            "description" => Request::input('description'),
            "category_id" => Request::input('category'),
        ];

        $response = $this->adminCheck();
        if (isset($response)) {
            return $response;
        }

        if (!Forum::valid($data)) {
            return Response::make('Bad Request', 400);
        }

        Forum::create($data);
    }

    public function forumPostStore()
    {
        if (!Auth::check()) {
            return Response::make('Unauthorized', 401);
        }

        $user = Auth::user();

        $data = [
            "author_id" => $user->id,
            "title" => Request::input('title'),
            "body" => $this->sanitizeData(Request::input('body')),
            "forum_id" => Request::input('forum_id')
        ];

        if (!ForumPost::valid($data)) {
            return Response::make('Bad Request', 400);
        }

        $post = ForumPost::create($data);

        event(new PostCreated($post, $user));
        return Redirect::route('forum.post.view', $post->id);
    }

    public function forumReplyStore()
    {
        if (!Auth::check()) {
            return Response::make('Unauthorized', 401);
        }

        $user = Auth::user();

        $data = [
            'author_id' => $user->id,
            'body' => $this->sanitizeData(Request::input('body')),
            'post_id' => Request::input('post_id'),
        ];

        if (!ForumReply::valid($data)) {
            return Redirect::route('forum.post.view', $data['post_id']);
        }

        $reply = ForumReply::create($data);

        event(new PostReply($reply, $user));
        return Redirect::route('forum.post.view', $data['post_id']);
    }

    private function adminCheck()
    {
        if (!$this->canAdministrate()) {
            return Response::make('Unauthorised', 401);
        }
    }

    private function sanitizeData($data)
    {
        /* Sanitize post input */
        $removals = [
            '/<script\b[^>]*>/',
            '/<\/script\b[^>]*>/'
        ];
        foreach ($removals as $r) {
            $data = preg_replace($r, '', $data);
        }
        return $data;
    }
}
