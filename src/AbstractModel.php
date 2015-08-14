<?php namespace Taskforcedev\LaravelForum;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AbstractModel
 * Extends Illuminate\Database\Eloquent\Model
 *
 * @package Taskforcedev\LaravelForum
 */
class AbstractModel extends Model
{
    use \Illuminate\Console\AppNamespaceDetectorTrait;

    public function getNamespace()
    {
        return $this->getAppNamespace();
    }

    /**
     * Helper method to get the count of items from a table.
     */
    public function getCount()
    {
        $count = \DB::select('select COUNT(*) as `count` from ' . $this->table);
        return $count[0]->count;
    }
}
