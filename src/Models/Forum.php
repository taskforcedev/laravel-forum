<?php

namespace Taskforcedev\LaravelForum\Models;

use \DB;
use \Validator;

/**
 * Class Forum
 *
 * @property integer $id          Forum ID.
 * @property string  $name        Forum Name.
 * @property string  $description Forum Description.
 * @property integer $category_id Category ID.
 * @property integer $public      Whether the forum is publicly viewable.
 *
 * @package Taskforcedev\LaravelForum\Models
 */
class Forum extends AbstractModel
{
    public $table = 'forums';

    public $fillable = ['name', 'description', 'category_id', 'public'];

    /**
     * Eloquent Relation.
     * @return mixed
     */
    public function category()
    {
        return $this->belongsTo(ForumCategory::class);
    }

    /**
     * Eloquent Relation.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(ForumPost::class);
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
     *
     * @param array|object $data The data to validate.
     *
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
