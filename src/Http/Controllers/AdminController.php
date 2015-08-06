<?php namespace Taskforcedev\LaravelForum\Http\Controllers;

use \Schema;
use Taskforcedev\LaravelForum\Database\Migrator;
use Taskforcedev\LaravelForum\Forum;
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
            return \Redirect::route('forum.index');
        }

        $data = $this->buildData();
        return view('laravel-forum::admin/index', $data);
    }

    /**
     * @return mixed
     */
    public function forums()
    {
        if (!$this->canAdministrate()) {
            return \Redirect::route('forum.index');
        }

        $data = $this->buildData();
        $data['categories'] = ForumCategory::all();
        $data['forums'] = Forum::all();
        return view('laravel-forum::admin/forums', $data);
    }

    /**
     * @return mixed
     */
    public function categories()
    {
        if (!$this->canAdministrate()) {
            return \Redirect::route('forum.index');
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
            'modalType' => $this->getModalType(),
            'layout' => config('laravel-forum.layout'),
        ];
    }
}
