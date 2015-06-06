<?php namespace Taskforcedev\LaravelForum\Http\Controllers;

use \Auth;
use Illuminate\Routing\Controller;

class ForumController extends Controller
{
    public function index()
    {
        $data = [
            'user' => (Auth::check() ? \Auth::user() : ''),
            'layout' => config('laravel-forum.layout'),
        ];
        return view('laravel-forum::forum/index', $data);
    }
}