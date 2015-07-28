<?php namespace Taskforcedev\LaravelForum\Http\Controllers;

use Taskforcedev\LaravelForum\Forum;
use Taskforcedev\LaravelForum\ForumCategory;

class ForumController extends BaseController
{
    public function index()
    {
        $data = $this->buildData();
        return view('laravel-forum::forum.index', $data);
    }

    public function view($id)
    {
        $data = $this->buildData();
        try {
            $forum = Forum::where('id', $id)->firstOrFail();
            $data['forum'] = $forum;
            return view('laravel-forum::forum.forum', $data);
        } catch (\Exception $e) {
            return view('404');
        }
    }

    public function createPost($forum_id)
    {
        try {
            $forum = Forum::where('id', $forum_id)->firstOrFail();
            $data = $this->buildData();
            $data['forum_id'] = $forum_id;
            return view('forum/createPost', $data);
        } catch (\Exception $e) {
            return view('404');
        }
    }

    private function buildData()
    {
        return [
            'user' => $this->getUser(),
            'layout' => $this->getLayout(),
            'categories' => ForumCategory::with('forums')->get(),
            'sitename' => config('laravel-forum.sitename'),
        ];
    }
}
