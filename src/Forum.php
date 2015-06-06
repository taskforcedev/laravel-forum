<?php namespace Taskforcedev\LaravelForum;

use \DB;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    public $table = 'forums';

    public $fillable = ['name', 'description', 'category_id'];

    /**
     * Eloquent Relation
     * @return mixed
     */
    public function category()
    {
        return $this->belongsTo('ForumCategory');
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
            'name' => ['required', 'min:3'],
            'category_id' => ['required', 'min:0', 'integer']
        ];
        $validator = Validator::make($data, $rules);

        if ($validator->passes()) {
            return true;
        }
        return false;
    }
}
