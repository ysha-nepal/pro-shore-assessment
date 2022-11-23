<?php 

namespace Core\Models;

use Spatie\Permission\Models\Role as BaseRole;


class Role extends BaseRole
{
    public $pivots = [
        'permissions'
    ];
}