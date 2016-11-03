<?php

namespace App\Http\Terranet\Administrator\Actions\Handlers;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Terranet\Administrator\Traits\Actions\BatchSkeleton;
use Terranet\Administrator\Traits\Actions\Skeleton;

class ToggleCollectionActivity
{
    use Skeleton, BatchSkeleton;

    /**
     * Perform a batch action.
     *
     * @param Eloquent $entity
     * @param array $collection
     * @return mixed
     */
    public function handle(Eloquent $entity, $request = null)
    {
        dd($entity, $request->all());

        return $entity;
    }
}