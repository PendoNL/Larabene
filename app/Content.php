<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use Sluggable;

    /**
     * @var string $table
     */
    protected $table = 'pages';

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'menu_text'
            ]
        ];
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'slug', 'menu_text', 'title', 'content'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function metas()
    {
        return $this->morphMany(\App\Meta::class, 'metable');
    }

    /**
     * @return array
     */
    public function pageMeta()
    {
        $return = [];

        foreach ($this->metas as $meta) {
            $return[$meta->name] = $meta->value;
        }

        return $return;
    }
}
