<?php

namespace Core\Models\Traits;

use Core\Models\Media;

trait HasMedia
{
    public $media = true;

    public $mediaField = 'medias';

    public function medias()
    {
        return $this->morphToMany(Media::class, 'mediable', 'model_has_medias');
    }

    public function image()
    {
        return $this->medias()->where('type', 'image')->first();
    }
}
