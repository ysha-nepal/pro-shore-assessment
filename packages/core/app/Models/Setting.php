<?php

namespace Core\Models;

use Core\Models\BaseModel;

class Setting extends BaseModel
{
    protected $table = "core_settings";

    protected $casts = [
        'values' => 'json'
    ];

    protected $fillable = [
        'name',
        'display_name',
        'permission',
        'package',
        'values'
    ];
}
