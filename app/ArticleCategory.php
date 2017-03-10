<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $sluggable = [
        'build_from'    => 'name',
        'save_to'       => 'slug',
        'on_update'     => true,
    ];

    public $timestamps = false;
    protected $fillable = ['name', 'slug'];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeAlphabetical($query)
    {
        return $query->orderBy('name', 'ASC');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany('App\Article', 'category_id', 'id');
    }

}
