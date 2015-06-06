<?php namespace Taskforcedev\LaravelForum\Http\Controllers;

use \Auth;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    /**
     * Returns the user object (or guest).
     * @return object
     */
    public function getUser()
    {
        return (Auth::check() ? \Auth::user() : (object)['name' => 'Guest', 'email' => 'guest@example.com']);
    }

    /**
     * Gets the layout from configuration.
     * @return mixed
     */
    public function getLayout()
    {
        return config('laravel-forum.layout');
    }
}