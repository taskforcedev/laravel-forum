<?php

class ForumReply extends Eloquent
{
    protected $table = 'forum_post_replies';

    protected $hidden = [];
    protected $fillable = ['body', 'post_id', 'author_id'];

    public function author()
    {
        return $this->belongsTo('User');
    }

    public function posted_at()
    {
        return date("d/m/Y",strtotime($this->created_at)) . ' @ ' . date("H:i",strtotime($this->created_at));
    }

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

    public static function getReplyCount()
    {
        $results = DB::select('select COUNT(*) as count from forum_post_replies');
        return $results[0]->count;
    }
}
