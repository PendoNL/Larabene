<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function metable()
    {
        return $this->morphTo();
    }
}
