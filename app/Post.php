<?php

namespace App;

use App\Presenters\PostPresenter;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Illuminate\Database\Eloquent\Model;
use Terranet\Presentable\PresentableInterface;
use Terranet\Presentable\PresentableTrait;
use Terranet\Translatable\HasTranslations;
use Terranet\Translatable\Translatable;

class Post extends Model implements PresentableInterface, Translatable, StaplerableInterface
{
    use PresentableTrait;

    use HasTranslations, EloquentTrait {
        HasTranslations::getAttribute as getTranslatedAttribute;
        HasTranslations::setAttribute as setTranslatedAttribute;
        EloquentTrait::getAttribute as getStaplerableAttribute;
        EloquentTrait::setAttribute as setStaplerableAttribute;
    }

    protected $presenter = PostPresenter::class;

    protected $fillable = [
        'user_id', 'slug', 'published', 'image'
    ];

    protected $translatedAttributes = ['title', 'excerpt', 'body'];

    public function __construct(array $attributes = [])
    {
        $this->hasAttachedFile('image', [
            'styles' => [
                'medium' => '300x300',
                'thumb' => '100x100',
            ],
        ]);

        parent::__construct($attributes);
    }

    public function getAttribute($key)
    {
        if ($this->isKeyReturningTranslationText($key)) {
            return $this->getTranslatedAttribute($key);
        } else if (array_key_exists($key, $this->attachedFiles)) {
            return $this->getStaplerableAttribute($key);
        }

        return parent::getAttribute($key);
    }

    public function setAttribute($key, $value)
    {
        if ($this->hasTranslatedAttributes() && in_array($key, $this->translatedAttributes)) {
            return $this->setTranslatedAttribute($key, $value);
        } else if (array_key_exists($key, $this->attachedFiles)) {
            return $this->setStaplerableAttribute($key, $value);
        }

        return parent::setAttribute($key, $value);
    }

    public function scopeActive($query)
    {
        return $query->wherePublished(1);
    }

    public function scopeHidden($query)
    {
        return $query->wherePublished(0);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_categories');
    }
}
