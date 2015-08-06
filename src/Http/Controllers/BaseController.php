<?php namespace Taskforcedev\LaravelForum\Http\Controllers;

use \Auth;
use \Schema;
use Illuminate\Routing\Controller;
use Taskforcedev\LaravelForum\ForumCategory;
use Taskforcedev\LaravelForum\Helpers\UserHelper;
use Taskforcedev\LaravelForum\Database\Migrator;

/**
 * Class BaseController
 * @package Taskforcedev\LaravelForum\Http\Controllers
 */
class BaseController extends Controller
{
    public function __construct()
    {
        $migrator = new Migrator();
        $migrator->migrate();

        if (!Schema::hasTable('forums')) {
            return 'Laravel Forums: Error: Unable to migrate tables.';
        }

        return false;
    }

    /**
     * Returns the user object (or guest).
     * @return object
     */
    public function getUser()
    {
        return (Auth::check() ? \Auth::user() : $this->guest());
    }

    /**
     * Gets the layout from configuration.
     * @return mixed
     */
    public function getLayout()
    {
        return config('laravel-forum.layout');
    }

    /**
     * Gets the modal type preference from config.
     * @return mixed
     */
    public function getModalType()
    {
        return config('laravel-forum.modal.type');
    }

    /**
     * Determine if the user can administrate the forums
     * @return boolean
     */
    protected function canAdministrate()
    {
        $user = $this->getUser();

        if ($user->name == 'Guest' && $user->email == 'guest@example.com') {
            return false;
        }

        if (method_exists($user, 'can')) {
            return $user->can('forum-administrate');
        }

        // If no method of authorizing return false;
        return false;
    }

    /**
     * Determine if the user can moderate the forums.
     * @return boolean
     */
    protected function canModerate()
    {
        $user = $this->getUser();

        if ($user->name == 'Guest' && $user->email == 'guest@example.com') {
            return false;
        }

        if (method_exists($user, 'can')) {
            return $user->can('forum-moderate');
        }

        // If no method of authorizing return false;
        return false;
    }

    /**
     * Retrieve a user model or object for the Guest user.
     * @return object
     */
    public function guest()
    {
        /* Get the namespace */
        $model = $this->getUserModel();
        if ($model) {
            $guest = new $model();
            $guest->name = 'Guest';
            $guest->email = 'guest@example.com';
        } else {
            $guest = (object)['name' => 'Guest', 'email' => 'guest@example.com'];
        }
        return $guest;
    }

    /**
     * Attempt to retrieve the user model class name (namespaced).
     * @return boolean|string
     */
    public function getUserModel()
    {
        $helper = new UserHelper();
        return $helper->getUserModel();
    }

    /**
     * Builds data required for views.
     * @return array
     */
    protected function buildData()
    {
        return [
            'user' => $this->getUser(),
            'layout' => $this->getLayout(),
            'categories' => ForumCategory::with('forums')->get(),
            'sitename' => config('laravel-forum.sitename'),
            'wysiwyg' => config('laravel-forum.wysiwyg')
        ];
    }
}
