<?php namespace Taskforcedev\LaravelForum\Http\Controllers;

use \Request;
use \Schema;
use Taskforcedev\LaravelForum\Forum;
use Taskforcedev\LaravelForum\ForumCategory;
use Taskforcedev\LaravelForum\ForumPost;
use Taskforcedev\LaravelForum\ForumReply;

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
            "category_id" => Request::input('category_id'),
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

        $data = [
            "author_id" => Request::input('author_id'),
            "title" => Request::input('title'),
            "body" => $this->sanitizeData(Request::input('body')),
            "forum_id" => Request::input('forum_id')
        ];

        if (!ForumPost::valid($data)) {
            \Log::debug($data);
            return Response::make('Bad Request', 400);
        }

        $post = ForumPost::create($data);

        /* Fire post creation event */
        $eData = [
            'author_name' => User::getUsersUsername($data['author_id']),
            'post_title' => $data['title'],
        ];
        Event::fire('forum.post.created', $eData);

        return Redirect::route('forum.post.view', $post->id);
    }

    public function forumReplyStore()
    {
        if (!Auth::check()) {
            return Response::make('Unauthorized', 401);
        }

        $data = [
            'author_id' => Request::input('author_id'),
            'body' => $this->sanitizeData(Input::get('body')),
            'post_id' => Input::get('post_id'),
        ];

        if (!ForumPostReply::valid($data)) {
            return Redirect::route('forum.post.view', $data['post_id']);
        }

        $reply = ForumPostReply::create($data);
        /* Fire event notification */
        $post = ForumPost::getPostById($data['post_id']);
        $op_user = User::where('id', $post->author_id)->first(); // Original Post Author

        $eData = [
            'author_name' => User::getUsersUsername($data['author_id']),
            'post_name' => $post->title,
            'email' => $op_user->email
        ];

        Event::fire('forum.post.reply', $eData);

        return Redirect::route('forum.post.view', $data['post_id']);
    }

    public function adminCheck()
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
        foreach($removals as $r) {
            $data = preg_replace($r, '', $data);
        }
        return $data;
    }
}
