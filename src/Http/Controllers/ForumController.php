<?php namespace Taskforcedev\LaravelForum\Http\Controllers;

use Taskforcedev\LaravelForum\ForumCategory;

class ForumController extends BaseController
{
    public function index()
    {
        $data = [
            'user' => $this->getUser(),
            'layout' => $this->getLayout(),
            'categories' => ForumCategory::with('forums')->get(),
        ];
        return view('laravel-forum::forum/index', $data);
    }
}
