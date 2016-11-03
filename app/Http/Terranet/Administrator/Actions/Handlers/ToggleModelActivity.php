<?php

namespace App\Http\Terranet\Administrator\Actions\Handlers;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Terranet\Administrator\Traits\Actions\ActionSkeleton;
use Terranet\Administrator\Traits\Actions\Skeleton;

class ToggleModelActivity
{
    use Skeleton, ActionSkeleton;

    public function name($eloquent)
    {
        return $eloquent->published ? 'Unpublish' : 'Publish';
    }

    /**
     * Update single entity.
     *
     * @param Eloquent $entity
     * @return mixed
     */
    public function handle(Eloquent $entity)
    {
        $entity->published = ! $entity->published;

        $entity->save();

        return $entity;
    }

    public function authorize($user, $post)
    {
        return $user->id == $post->user_id;
    }
}