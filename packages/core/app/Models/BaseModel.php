<?php

namespace Core\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class BaseModel extends Model implements Auditable
{
    use  \OwenIt\Auditing\Auditable;
}
