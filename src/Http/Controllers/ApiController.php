<?php namespace Taskforcedev\LaravelForum\Http\Controllers;

use \Auth;
use \Event;
use \Redirect;
use \Schema;

use Illuminate\Http\Request;

use Taskforcedev\LaravelForum\Events\PostCreated;
use Taskforcedev\LaravelForum\Events\PostReply;
use Taskforcedev\LaravelForum\Models\Forum;
use Taskforcedev\LaravelForum\Models\ForumCategory;
use Taskforcedev\LaravelForum\Models\ForumPost;
use Taskforcedev\LaravelForum\Models\ForumReply;

/**
 * Class ApiController
 * @package Taskforcedev\LaravelForum\Http\Controllers
 */
class ApiController extends BaseController
{
    public function forumCategoryStore(Request $request)
    {
        $data = [
            "name" => $request->input('name'),
        ];

        $response = $this->adminCheck();
        if (isset($response)) {
            return $response;
        }

        /* If data invalid return bad request */
        if (!ForumCategory::valid($data)) {
            return response('Bad Request', 400);
        }

        ForumCategory::create($data);

        /* After creating a category lets redirect back to the category list. */
        return redirect()->route('laravel-forum.admin.categories');
    }

    public function forumStore(Request $request)
    {
        $data = [
            "name" => $request->input('name'),
            "description" => $request->input('description'),
            "category_id" => $request->input('category'),
        ];

        $response = $this->adminCheck();
        if (isset($response)) {
            return $response;
        }

        if (!Forum::valid($data)) {
            return response('Bad Request', 400);
        }

        Forum::create($data);

        /* After creating a forum lets redirect back to the forum list. */
        return redirect()->route('laravel-forum.admin.forums');
    }

    public function forumPostStore(Request $request)
    {
        if (!Auth::check()) {
            return response('Unauthorized', 401);
        }

        $user = Auth::user();

        $forum_id = $request->input('forum_id');

        $data = [
            "author_id" => $user->id,
            "title" => $request->input('title'),
            "body" => $this->sanitizeData($request->input('body')),
            "forum_id" => $forum_id
        ];

        if (!ForumPost::valid($data)) {
            return response('Bad Request', 400);
        }

        $post = ForumPost::create($data);

        event(new PostCreated($post, $user));
        return redirect()->route('laravel-forum.view.post', [$forum_id , $post->id]);
    }

    public function forumReplyStore(Request $request)
    {
        if (!Auth::check()) {
            return response('Unauthorized', 401);
        }

        $user = Auth::user();

        $forum_id = $request->input('forum_id');
        $post_id = $request->input('post_id');

        $data = [
            'author_id' => $user->id,
            'body' => $this->sanitizeData($request->input('body')),
            'post_id' => $post_id,
        ];

        if (!ForumReply::valid($data)) {
            return redirect()->route('laravel-forum.view.post', [$forum_id, $post_id]);
        }

        $reply = ForumReply::create($data);

        event(new PostReply($reply, $user));
        return redirect()->route('laravel-forum.view.post', [$forum_id, $post_id]);
    }

    private function adminCheck()
    {
        if (!$this->canAdministrate()) {
            return response('Unauthorised', 401);
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

    public function lockPost(Request $request, $id)
    {
        if (!$this->canAdministrate() && !$this->canModerate()) {
            return response('Unauthorised', 401);
        }

        $post = $this->postExists($id);
        if (!$post) {
            return response('Post not found', 404);
        }

        $post->locked = 1;
        $post->save();
        return response('Post Locked', 200);
    }

    public function unlockPost(Request $request, $id)
    {
        if (!$this->canAdministrate() && !$this->canModerate()) {
            return response('Unauthorised', 401);
        }

        $post = $this->postExists($id);
        if (!$post) {
            return response('Post not found', 404);
        }

        $post->locked = 0;
        $post->save();
        return response('Post Unlocked', 200);
    }

    public function stickyPost(Request $request, $id)
    {
        if (!$this->canAdministrate() && !$this->canModerate()) {
            return response('Unauthorised', 401);
        }

        $post = $this->postExists($id);
        if (!$post) {
            return response('Post not found', 404);
        }

        $post->sticky = 1;
        $post->save();
        return response('Post Unlocked', 200);
    }

    public function unstickyPost(Request $request, $id)
    {
        if (!$this->canAdministrate() && !$this->canModerate()) {
            return response('Unauthorised', 401);
        }

        $post = $this->postExists($id);
        if (!$post) {
            return response('Post not found', 404);
        }

        $post->sticky = 0;
        $post->save();
        return response('Post Unlocked', 200);
    }

    private function postExists($post_id)
    {
        try {
            $post = ForumPost::where('id', $post_id)->firstOrFail();
            return $post;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function postDelete($forum_id, $post_id)
    {
        if (!$this->canAdministrate() && !$this->canModerate()) {
            return response('Unauthorised', 401);
        }

        $post = $this->postExists($post_id);
        if (!$post) {
            return response('Post not found', 404);
        }

        $post->delete();
        return response('Post Deleted', 200);
    }

    public function forumDelete(Request $request)
    {
        if (!$this->canAdministrate() && !$this->canModerate()) {
            return response('Unauthorised', 401);
        }

        $forum_id = $request->input('forum_id');

        $forum = $this->forumExists($forum_id);
        if (!$forum) {
            return response('Forum not found', 404);
        }

        $forum->delete();
        return response('Forum Deleted', 200);
    }

    private function forumExists($id)
    {
        try {
            $forum = Forum::where('id', $id)->firstOrFail();
            return $forum;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function forumCategoryDelete(Request $request)
    {
        if (!$this->canAdministrate() && !$this->canModerate()) {
            return response('Unauthorised', 401);
        }

        $cat_id = $request->input('category_id');

        $cat = $this->forumCategoryExists($cat_id);
        if (!$cat) {
            return response('Forum Category not found', 404);
        }

        $cat->delete();
        return response('Forum Category Deleted', 200);
    }

    private function forumCategoryExists(Request $request, $id)
    {
        try {
            $cat = ForumCategory::where('id', $id)->firstOrFail();
            return $cat;
        } catch (\Exception $e) {
            return false;
        }
    }
}
