<?php namespace Taskforcedev\LaravelForum\Helpers;

use Illuminate\Console\AppNamespaceDetectorTrait;
use Taskforcedev\LaravelForum\ForumPost;
use Taskforcedev\LaravelForum\ForumReply;

class UserHelper
{
    use AppNamespaceDetectorTrait;

    public function getUserModel()
    {
        /* Get the namespace */
        $ns = $this->getAppNamespace();

        if ($ns) {
            /* Try laravel default convention (models in the app folder). */
            $model = $ns . 'User';
            if (class_exists($model)) {
                return $model;
            }

            /* Try secondary convention of having a models directory. */
            $model = $ns . 'Models\User';
            if (class_exists($model)) {
                return $model;
            }
        }
        return false;
    }

    public function getPostCount($user_id)
    {
        /* Get count from forum posts */
        try {
            $posts = ForumPost::where('author_id', $user_id)->get();
            $posts = count($posts);
        } catch (Exception $e) {
            $posts = 0;
        }

        /* Get count from forum replies */
        try {
            $replies = ForumReply::where('author_id', $user_id)->get();
            $replies = count($replies);
        } catch (Exception $e) {
            $replies = 0;
        }

        /* Return total */
        return $posts + $replies;
    }
}
