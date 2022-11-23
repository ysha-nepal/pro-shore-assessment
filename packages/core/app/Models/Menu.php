<?php

namespace Core\Models;

use Core\Models\BaseModel;

class Menu extends BaseModel
{
    protected $table = "core_menus";

    protected $fillable = [
        "name","package","display_name","permission","order","status","icon","parent_id","route"
    ];

    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Menu::class,'parent_id');
    }
}
