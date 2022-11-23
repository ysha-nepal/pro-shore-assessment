<?php

namespace Core\Controllers\Admin;

use Core\Controllers\Traits\CrudTrait;
use App\Http\Controllers\Controller;
use Core\Repositories\Admin\MediaRepository;
use Core\UI\MediaUI;

class MediaController extends Controller
{
    use CrudTrait;

    protected $model;

    public function __construct(MediaRepository $model)
    {
        $this->model = $model;
        $this->ui = new MediaUI;
        $this->view = "medias";
        $this->title = "Medias";
        $this->package = "core";
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function download($id)
    {
        $this->checkPermission($this->ui->getPermission('download'));
        $model = $this->model->findOrFail($id);
        return response()->download($model->storage_path);
    }
}
