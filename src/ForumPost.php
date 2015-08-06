<?php namespace Taskforcedev\LaravelForum;

use \Exception;
use Taskforcedev\LaravelForum\Helpers\UserHelper;
use \Validator;

/**
 * Class ForumPost
 *
 * @property string  $title
 * @property string  $body
 * @property integer $forum_id
 * @property integer $author_id
 *
 * @package Taskforcedev\LaravelForum
 */
class ForumPost extends AbstractModel
{
    public $table = 'forum_posts';

    public $fillable = ['title', 'body', 'forum_id', 'author_id'];

    public function author()
    {
        $userHelper = new UserHelper();
        $model = $userHelper->getUserModel();
        return $this->belongsTo($model);
    }

    public function forum()
    {
        return $this->belongsTo('Taskforcedev\LaravelForum\Forum');
    }

    public function replies()
    {
        $local = 'id';
        $foreign = 'post_id';
        return $this->hasMany('Taskforcedev\LaravelForum\ForumReply', $foreign, $local);
    }

    /**
     * Is model data valid.
     * @param array|object $data The data to validate.
     * @return boolean
     */
    public static function valid($data)
    {
        $rules = [
            'title' => 'required|min:3|max:100',
            'body' => 'required|min:5',
            'forum_id' => 'required|exists:forums,id',
            'author_id' => 'required|min:1|exists:users,id',
        ];
        $validator = Validator::make($data, $rules);

        if ($validator->passes()) {
            return true;
        }
        return false;
    }

    /**
     * Gets the last reply for the current forum post.
     * @return array
     */
    public function lastReply()
    {
        try {
            $replies = ForumReply::where('post_id', $this->id)->get();

            if ($replies->isEmpty()) {
                return null;
            }

            $reply = $replies->last();

            return [
                'author' => $reply->author->username,
                'date' => $reply->created_at
            ];
        } catch (Exception $e) {
            return null;
        }
    }
}
