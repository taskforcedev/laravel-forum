<?php namespace Taskforcedev\LaravelForum\Http\Controllers;

use \Auth;
use \Schema;
use Taskforcedev\LaravelSupport\Http\Controllers\Controller;
use Taskforcedev\LaravelForum\ForumCategory;
use Taskforcedev\LaravelForum\Helpers\UserHelper;
use Taskforcedev\LaravelForum\Database\Migrator;
use Taskforcedev\LaravelForum\Helpers\Sanitizer;

/**
 * Class BaseController
 * @package Taskforcedev\LaravelForum\Http\Controllers
 */
class BaseController extends Controller
{
    public $sanitizer;

    public function __construct()
    {
        $this->sanitizer = new Sanitizer();

        $migrator = new Migrator();
        $migrator->migrate();
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
            'wysiwyg' => config('laravel-forum.wysiwyg'),
            'sanitizer' => $this->sanitizer,
            'userHelper' => new UserHelper()
        ];
    }
}
