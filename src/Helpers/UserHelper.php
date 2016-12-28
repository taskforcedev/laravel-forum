<?php namespace Taskforcedev\LaravelForum\Helpers;

use \Exception;
use Taskforcedev\LaravelForum\Models\ForumPost;
use Taskforcedev\LaravelForum\Models\ForumReply;
use Taskforcedev\LaravelSupport\Helpers\User as SupportUserHelper;

/**
 * Class UserHelper
 * @package Taskforcedev\LaravelForum\Helpers
 */
class UserHelper extends SupportUserHelper
{
    /**
     * Get a users post count (posts created and replies).
     * @param int $user_id User Id.
     * @return int
     */
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
