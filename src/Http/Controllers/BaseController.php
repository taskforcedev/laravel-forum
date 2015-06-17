<?php namespace Taskforcedev\LaravelForum\Http\Controllers;

use \Auth;
use Illuminate\Routing\Controller;
use Illuminate\Console\AppNamespaceDetectorTrait;

class BaseController extends Controller
{
    use AppNamespaceDetectorTrait;

    /**
     * Returns the user object (or guest).
     * @return object
     */
    public function getUser()
    {
        if (Auth::check()) {
            return Auth::user();
        } else {
            // get guest (user model
        }
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

    public function getModalType()
    {
        return config('laravel-forum.modal.type');
    }

    /**
     * Determine if the user can administrate the forums
     * @return boolean
     */
    public function canAdministrate()
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

    public function canModerate()
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
        /* Get the namespace */
        $ns = $this->getNamespace();

        if ($ns) {
            $model = $ns . 'User';
            if (class_exists($model)) {
                return $model;
            }

            $model = $ns . 'Models/User';
            if (class_exists($model)) {
                return $model;
            }
        }
        return false;
    }

    /**
     * Attempt to retrieve the applications namespace.
     * @return string|boolean
     */
    public function getNamespace()
    {
        try {
            $ns = $this->getAppNamespace();
            return $ns;
        } catch (\Exception $e) {
            return false;
        }
    }
}
