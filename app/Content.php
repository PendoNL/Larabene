<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Content extends Model implements SluggableInterface
{
    use SluggableTrait;

    /**
     * @var string $table
     */
    protected $table = 'pages';

    /**
     * @var array $sluggable
     */
    protected $sluggable = [
        'build_from'    => 'menu_text',
        'save_to'       => 'slug',
        'on_update'     => true,
    ];

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
}
