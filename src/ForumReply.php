<?php namespace Taskforcedev\LaravelForum;

use \Validator;

/**
 * Class ForumReply
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
        return $this->belongsTo('User');
    }

    /**
     * Returns the created_at date in a more readable form.
     * @return string
     */
    public function posted_at()
    {
        return date("d/m/Y",strtotime($this->created_at)) . ' @ ' . date("H:i",strtotime($this->created_at));
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
            'body' => ['required', 'min:3'],
            'post_id' => ['required', 'min:1', 'integer'],
            'author_id' => ['required', 'min:1', 'integer']
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
