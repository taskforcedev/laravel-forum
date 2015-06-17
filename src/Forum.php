<?php namespace Taskforcedev\LaravelForum;

use \DB;
use \Validator;

/**
 * Class Forum
 *
 * @property string  $name
 * @property string  $description
 * @property integer $category_id
 *
 * @package Taskforcedev\LaravelForum
 */
class Forum extends AbstractModel
{
    public $table = 'forums';

    public $fillable = ['name', 'description', 'category_id', 'public'];

    /**
     * Eloquent Relation
     * @return mixed
     */
    public function category()
    {
        return $this->belongsTo('Taskforcedev\LaravelForum\ForumCategory');
    }

    public function posts()
    {
        return $this->hasMany('Taskforcedev\LaravelForum\ForumPost');
    }

    /**
     * Get the number of threads inside the current forum.
     * @return mixed
     */
    public function getThreadCount()
    {
        try {
            $result = DB::select('SELECT COUNT(*) as count FROM `forum_posts` where forum_id = ?', [$this->id]);
            return $result[0]->count;
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Is model data valid.
     * @param array|object $data The data to validate.
     * @return boolean
     */
    public static function valid($data)
    {
        $rules = [
            'name'        => 'required|min:3',
            'description' => 'min:3',
            'category_id' => 'required|min:0|integer|exists:forum_categories,id',
        ];
        $validator = Validator::make($data, $rules);

        if ($validator->passes()) {
            return true;
        }
        return false;
    }
}
