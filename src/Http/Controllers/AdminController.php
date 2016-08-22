<?php namespace Taskforcedev\LaravelForum\Http\Controllers;

use \Schema;
use Taskforcedev\LaravelForum\Database\Migrator;
use Taskforcedev\LaravelForum\Forum;
use Taskforcedev\LaravelForum\ForumPost;
use Taskforcedev\LaravelForum\ForumReply;
use Taskforcedev\LaravelForum\ForumCategory;

/**
 * Class AdminController
 * @package Taskforcedev\LaravelForum\Http\Controllers
 */
class AdminController extends BaseController
{
    /**
     * Admin index.
     * @return mixed
     */
    public function index()
    {
        if (!$this->canAdministrate()) {
            return redirect()->route('laravel-forum.index');
        }

        $data = $this->buildData();

        $data['counts'] = [
            'forum' => (new Forum)->getCount(),
            'category' => (new ForumCategory)->getCount(),
            'post' => (new ForumPost)->getCount(),
            'reply' => (new ForumReply)->getCount(),
        ];

        return view('laravel-forum::admin/index', $data);
    }

    /**
     * @return mixed
     */
    public function forums()
    {
        if (!$this->canAdministrate()) {
            return redirect()->route('laravel-forum.index');
        }

        $data = $this->buildData();
        $data['categories'] = ForumCategory::all();
        $data['forums'] = Forum::orderBy('category_id')->get();
        return view('laravel-forum::admin/forums', $data);
    }

    /**
     * @return mixed
     */
    public function categories()
    {
        if (!$this->canAdministrate()) {
            return redirect()->route('laravel-forum.index');
        }

        $data = $this->buildData();
        $data['categories'] = ForumCategory::all();
        return view('laravel-forum::admin/categories', $data);
    }

    /**
     * @return array
     */
    public function buildData()
    {
        return [
            'user' => $this->getUser(),
            'layout' => config('laravel-forum.layout'),
        ];
    }
}
