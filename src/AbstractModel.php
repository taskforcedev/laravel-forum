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
}
