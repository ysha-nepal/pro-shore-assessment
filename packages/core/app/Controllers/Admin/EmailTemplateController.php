<?php

namespace Core\Controllers\Admin;

use Core\Controllers\Traits\CrudTrait;
use App\Http\Controllers\Controller;
use Core\Repositories\Admin\EmailTemplateRepository;
use Core\UI\EmailTemplateUI;

class EmailTemplateController extends Controller
{
    use CrudTrait;

    protected $model;

    public function __construct(EmailTemplateRepository $model)
    {
        $this->model = $model;
        $this->ui = new EmailTemplateUI;
        $this->view = "email-templates";
        $this->title = "Email Templates";
        $this->package = "core";
    }
}
