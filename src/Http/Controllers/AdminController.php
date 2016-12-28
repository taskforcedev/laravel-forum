<?php namespace Taskforcedev\LaravelForum\Http\Controllers;

use \Schema;
use Illuminate\Http\Request;
use Taskforcedev\LaravelForum\Models\Forum;
use Taskforcedev\LaravelForum\Models\ForumPost;
use Taskforcedev\LaravelForum\Models\ForumReply;
use Taskforcedev\LaravelForum\Models\ForumCategory;

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

    public function forumForm()
    {
        if (!$this->canAdministrate()) {
            return redirect()->route('laravel-forum.index');
        }

        $data = $this->buildData();
        $data['categories'] = ForumCategory::all();
        return view('laravel-forum::admin.forum.create', $data);
    }

    public function categoryForm()
    {
        if (!$this->canAdministrate()) {
            return redirect()->route('laravel-forum.index');
        }

        $data = $this->buildData();
        return view('laravel-forum::admin.category.create', $data);
    }
}
