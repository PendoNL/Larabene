<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use File;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /*
     * Model is Sluggable
     */
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
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
     * Date fields.
     *
     * @var array
     */
    protected $dates = ['date'];

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'active', 'category_id', 'user_id', 'slug',
        'date', 'title', 'image', 'content', 'tags', 'highlighted',
    ];

    /**
     * A blog belongs to a category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(\App\ArticleCategory::class);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeHighlighted($query)
    {
        return $query->where('highlighted', 1);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeFront($query)
    {
        return $query->where('front', 1);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('updated_at', 'DESC');
    }

    /**
     * A blog is written by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

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

    /**
     * delete the image belonging to the article first.
     * then proceed with regular deleting.
     *
     * @return parent::delete()
     */
    public function delete()
    {
        if ($this->attributes['image']) {
            $file = $this->attributes['image'];
            $path = public_path('uploads/articles/'.$file);

            if (file::isfile($path)) {
                File::delete($path);
            }
        }

        parent::delete();
    }
}
