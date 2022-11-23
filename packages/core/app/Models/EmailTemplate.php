<?php

namespace Core\Models;

use Core\Models\BaseModel;

class EmailTemplate extends BaseModel
{
    protected $table = "email_templates";

    protected $fillable = [
        'title','slug','subject','content','status'
    ];
}
