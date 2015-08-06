<?php namespace Taskforcedev\LaravelForum\Helpers;

use Illuminate\Console\AppNamespaceDetectorTrait;

class UserHelper
{
    public function getUserModel()
    {
        /* Get the namespace */
        $ns = $this->getNamespace();

        if ($ns) {
            /* Try laravel default convention (models in the app folder). */
            $model = $ns . 'User';
            if (class_exists($model)) {
                return $model;
            }

            /* Try secondary convention of having a models directory. */
            $model = $ns . 'Models\User';
            if (class_exists($model)) {
                return $model;
            }
        }
        return false;
    }
}
