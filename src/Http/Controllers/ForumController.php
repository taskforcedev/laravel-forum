<?php namespace Taskforcedev\LaravelForum\Http\Controllers;

class ForumController extends BaseController
{
    public function index()
    {
        $data = [
            'user' => $this->getUser(),
            'layout' => $this->getLayout(),
        ];
        return view('laravel-forum::forum/index', $data);
    }
}
