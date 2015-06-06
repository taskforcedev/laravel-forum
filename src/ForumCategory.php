<?php namespace Taskforcedev\LaravelForum;

use \Validator;

class ForumCategory extends AbstractModel
{
    public $table = 'forum_categories';

    public $fillable = ['name'];

    /**
     * Eloquent Relation
     * @return mixed
     */
    public function forums()
    {
        return $this->hasMany('Forum');
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
}
