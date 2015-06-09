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
        return true; // while developing return true.
    }

    public function guest()
    {
        /* Get the namespace */
        $ns = $this->getNamespace();
        if ($ns) {
            $model = $ns . 'User';
            $guest = new $model();
            $guest->name = 'Guest';
            $guest->email = 'guest@example.com';
        } else {
            $guest = (object)['name' => 'Guest', 'email' => 'guest@example.com'];
        }

        return $guest;
    }

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
