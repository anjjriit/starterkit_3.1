<?php

namespace App\Http\Terranet\Administrator\Modules;

use App\Category;
use App\User;
use Terranet\Administrator\Contracts\Module\Editable;
use Terranet\Administrator\Contracts\Module\Exportable;
use Terranet\Administrator\Contracts\Module\Filtrable;
use Terranet\Administrator\Contracts\Module\Navigable;
use Terranet\Administrator\Contracts\Module\Sortable;
use Terranet\Administrator\Contracts\Module\Validable;
use Terranet\Administrator\Filters\FilterElement;
use Terranet\Administrator\Filters\Scope;
use Terranet\Administrator\Form\FormElement;
use Terranet\Administrator\Form\Type\Select;
use Terranet\Administrator\Scaffolding;
use Terranet\Administrator\Traits\Module\AllowFormats;
use Terranet\Administrator\Traits\Module\AllowsNavigation;
use Terranet\Administrator\Traits\Module\HasFilters;
use Terranet\Administrator\Traits\Module\HasForm;
use Terranet\Administrator\Traits\Module\HasSortable;
use Terranet\Administrator\Traits\Module\ValidatesForm;

/**
 * Administrator Resource Posts
 *
 * @package Terranet\Administrator
 */
class Posts extends Scaffolding implements Navigable, Filtrable, Editable, Validable, Sortable, Exportable
{
    use HasFilters, HasForm, HasSortable, ValidatesForm, AllowFormats, AllowsNavigation;

    /**
     * The module Eloquent model
     *
     * @var string
     */
    protected $model = 'App\\Post';

    public function columns()
    {
        return $this->scaffoldColumns()
            ->join(['excerpt', 'body'], 'content')
            ->move('content', 'before:dates')
            /*->update('user_id', function ($user) {
                return $user->setTemplate(function ($post) {
                    return $post->author->name;
                });
            })*/;
    }

    public function form()
    {
        $categories = FormElement::multiCheckbox('categories.category_id');
        $categories->getInput()->setOptions(
            Category::pluck('title', 'id')->toArray()
        );
        $categories->setTitle('Categories');

        return $this->scaffoldForm()
            ->update('user_id', function ($user) {
                $user->setInput(
                    (new Select('user_id'))
                        ->setOptions(User::pluck('name', 'id'))
                );

                return $user;
            })
            ->push($categories);
    }

    public function filters()
    {
        $user = FilterElement::select('user_id');
        $user->getInput()->setOptions(
            ['' => '--Any--'] + User::pluck('name', 'id')->toArray()
        );

        return $this->scaffoldFilters()
            ->push(
                $user
            );
    }

    public function scopes()
    {
        return $this->scaffoldScopes()
            ->push((new Scope('onlyAdmin'))->setQuery(function ($query) {
                return $query->whereUserId(1);
            }));
    }
}