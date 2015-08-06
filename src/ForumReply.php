<?php namespace Taskforcedev\LaravelForum;

use \DB;
use \Validator;

/**
 * Class ForumReply
 *
 * @property string  $body
 * @property integer $post_id
 * @property integer $author_id
 *
 * @package Taskforcedev\LaravelForum
 */
class ForumReply extends AbstractModel
{
    protected $table = 'forum_post_replies';

    protected $hidden = [];
    protected $fillable = ['body', 'post_id', 'author_id'];

    /**
     * Eloquent Relation
     * @return mixed
     */
    public function author()
    {
        $userHelper = new UserHelper();
        $model = $userHelper->getUserModel();
        return $this->belongsTo($model);
    }

    /**
     * Validates model data
     * @param array $data The data to validate.
     *
     * @return boolean
     */
    public static function valid($data)
    {
        $rules = [
            'body' => 'required|min:3',
            'post_id' => 'required|min:1|integer|exists:posts,id',
            'author_id' => 'required|min:1|integer|exists:users,id'
        ];
        $validator = Validator::make($data, $rules);

        if ($validator->passes()) {
            return true;
        }
        return false;
    }

    /**
     * Gets the number of replies from the database.
     * @return mixed
     */
    public static function getReplyCount()
    {
        $results = DB::select('select COUNT(*) as count from forum_post_replies');
        return $results[0]->count;
    }
}
