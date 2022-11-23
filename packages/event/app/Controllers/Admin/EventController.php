<?php

namespace Event\Controllers\Admin;

use Core\Controllers\Traits\CrudTrait;
use App\Http\Controllers\Controller;
use Event\Repositories\Admin\EventRepository;
use Event\UI\EventUI;

class EventController extends Controller
{
    use CrudTrait;

    protected $model;

    public function __construct(EventRepository $model)
    {
        $this->model = $model;
        $this->ui = new EventUI;
        $this->view = "events";
        $this->title = "Events";
        $this->package = "event";
        $this->export = "Event\Exports\EventExport";
    }
}
