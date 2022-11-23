<?php

namespace Core\Models;

use Core\Models\BaseModel;
use Spatie\Permission\Models\Permission as BasePermission;

class Permission extends BasePermission
{
    protected $table = "permissions";

    protected $fillable = [
        'package_name',
        'name',
        'guard_name',
    ];

}
