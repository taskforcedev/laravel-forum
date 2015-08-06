<?php namespace Taskforcedev\LaravelForum;

use \Validator;

/**
 * Class ForumCategory
 *
 * @property integer $id   Category ID.
 * @property string  $name Category Name.
 *
 * @package Taskforcedev\LaravelForum
 */
class ForumCategory extends AbstractModel
{
    public $table = 'forum_categories';

    public $fillable = ['name'];

    /**
     * Eloquent Relation.
     * @return mixed
     */
    public function forums()
    {
        return $this->hasMany('Taskforcedev\LaravelForum\Forum', 'category_id', 'id');
    }

    /**
     * Is model data valid.
     * @param array|object $data The data to validate.
     * @return boolean
     */
    public static function valid($data)
    {
        $rules = [
            'name' => ['required', 'min:3'],
        ];
        $validator = Validator::make($data, $rules);

        if ($validator->passes()) {
            return true;
        }
        return false;
    }

    /**
     * Returns the category as an html option.
     * @return string
     */
    public function toOption()
    {
        return "<option value=\"{$this->id}\">{$this->name}</option>";
    }

    /**
     * Return the category name as a string.
     * @return string
     */
    public function __toString()
    {
        return (string)$this->name;
    }
}
