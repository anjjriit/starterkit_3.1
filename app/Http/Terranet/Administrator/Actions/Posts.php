<?php

namespace App\Http\Terranet\Administrator\Actions;

use App\Http\Terranet\Administrator\Actions\Handlers\ToggleCollectionActivity;
use App\Http\Terranet\Administrator\Actions\Handlers\ToggleModelActivity;
use Terranet\Administrator\Services\CrudActions;

class Posts extends CrudActions
{
    public function actions()
    {
        return [
            ToggleModelActivity::class
        ];
    }

    public function batchActions()
    {
        return array_merge(parent::batchActions(), [
            ToggleCollectionActivity::class
        ]);
    }

    public function canUpdate($user, $eloquent)
    {
        return $user->id == $eloquent->user_id;
    }

    public function canDelete($user, $eloquent)
    {
        return $this->canUpdate($user, $eloquent);
    }
}