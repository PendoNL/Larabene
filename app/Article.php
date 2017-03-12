<?php

namespace App;

use File;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use App\ArticleComment;

class Article extends Model implements SluggableInterface
{

    /**
     * Model is Sluggable
     */
    use SluggableTrait;

    /**
     * Sluggable configuration
     * @var array $sluggable
     */
    protected $sluggable = [
        'build_from'    => 'title',
        'save_to'       => 'slug',
        'on_update'     => true,
    ];

    /**
     * Date fields
     * @var array $dates
     */
    protected $dates = ['date'];

    /**
     * Fillable fields
     * @var array $fillable
     */
    protected $fillable = [
        'type', 'active', 'category_id', 'user_id', 'slug',
        'date', 'title', 'image', 'content', 'tags', 'highlighted'
    ];
    
    /**
     * A blog belongs to a category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\ArticleCategory');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeHighlighted($query)
    {
        return $query->where('highlighted', 1);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeFront($query)
    {
        return $query->where('front', 1);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('date', 'DESC');
    }

    /**
     * A blog is written by a user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function metas()
    {
        return $this->morphMany('\App\Meta', 'metable');
    }

    /**
     * @return array
     */
    public function pageMeta() {
        $return = [];

        foreach($this->metas as $meta) {
            $return[$meta->name] = $meta->value;
        }

        return $return;
    }

    /**
     * delete the image belonging to the article first.
     * then proceed with regular deleting.
     * @return parent::delete()
     */
    public function delete()
    {
        if($this->attributes['image']) {
            $file = $this->attributes['image'];
            $path = public_path('uploads/articles/' . $file);

            if(file::isfile($path)){
                File::delete($path);
            }
        }

        parent::delete();
    }
}
