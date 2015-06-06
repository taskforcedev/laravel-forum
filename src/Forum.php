<?php namespace Taskforcedev\LaravelForum;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    public $table = 'forums';

    public $fillable = ['name', 'description', 'category_id'];
}
