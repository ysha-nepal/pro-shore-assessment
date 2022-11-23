<?php

namespace Core\Models;

use Core\Models\BaseModel;

class Backup extends BaseModel
{
    protected $table = "backups";

    protected $fillable = [
        'name','size'
    ];
}
