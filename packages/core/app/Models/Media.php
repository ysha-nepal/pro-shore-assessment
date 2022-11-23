<?php

namespace Core\Models;

use Core\Models\BaseModel;
use Core\Scopes\MediaScope;

class Media extends BaseModel
{
    protected $table = "medias";


    public $appends = [
        'storage_path'
    ];

    protected $fillable = [
        'name', 'slug', 'ext', 'type', 'path', 'size','user_id','title','description'
    ];

    public function getStoragePathAttribute()
    {
        return storage_path() . '/app' . $this->path;
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    protected static function booted()
    {
        static::addGlobalScope(new MediaScope());
    }
}
