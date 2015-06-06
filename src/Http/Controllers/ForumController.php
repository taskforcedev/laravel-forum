<?php namespace Taskforcedev\LaravelForum\Http\Controllers;

use Taskforcedev\LaravelForum\ForumCategory;

class ForumController extends BaseController
{
    public function index()
    {
        $data = $this->buildData();
        return view('laravel-forum::forum/index', $data);
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
