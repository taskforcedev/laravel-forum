<?php namespace Taskforcedev\LaravelForum\Http\Controllers;

use \Auth;
use \Schema;
use Taskforcedev\LaravelSupport\Http\Controllers\Controller;
use Taskforcedev\LaravelForum\Models\ForumCategory;
use Taskforcedev\LaravelForum\Helpers\UserHelper;
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

    public function canCreateForums()
    {
        if (!Auth::check()) {
            return false;
        }

        try {
            $user = Auth::user();
            return $user->can('create', Forum::class);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Builds data required for views.
     * @return array
     */
    protected function buildData($data = [])
    {
        $data['user'] = $this->getUser();
        $data['layout'] = $this->getLayout();
        $data['categories'] = ForumCategory::with('forums')->get();
        $data['sitename'] = $this->getSitename();
        $data['wysiwyg'] = config('laravel-forum.wysiwyg');
        $data['sanitizer'] = $this->sanitizer;
        $data['userHelper'] = new UserHelper();

        return $data;
    }
}
