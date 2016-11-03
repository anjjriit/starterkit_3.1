<?php

namespace App\Presenters;

use Terranet\Presentable\Presenter;

class PostPresenter extends Presenter
{
    public function adminUserId()
    {
        $author = $this->presentable->author;

        return link_to_route(
            'scaffold.view',
            $author->name,
            [
                'model' => 'users',
                'id' => $author->id
            ]
        );
    }

    public function adminBody()
    {
        return '<p class="text-muted">' .
                $this->presentable->body .
            '</p>';
    }
}