<?php

namespace Core\Controllers\Admin;

use Core\Controllers\Traits\CrudTrait;
use App\Http\Controllers\Controller;
use Core\Repositories\Admin\BackupRepository;
use Core\UI\BackupUI;
use Illuminate\Support\Facades\Artisan;

class BackupController extends Controller
{
    use CrudTrait;

    protected $model;

    public function __construct(BackupRepository $model)
    {
        $this->model = $model;
        $this->ui = new BackupUI;
        $this->view = "backups";
        $this->title = "Backup";
        $this->package = "core";
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->checkPermission($this->ui->getPermission('create'));
        Artisan::call('generate:backup');
        return redirect()->back()->with('message', 'Backup Created Successfully');
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
        $ds = DIRECTORY_SEPARATOR;
        $path = storage_path() . $ds . 'app' . $ds . 'backups' . $ds . $model->name;
        return response()->download($path);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $this->checkPermission($this->ui->getPermission('destroy'));
        $model = $this->model->findOrFail($id);
        $ds = DIRECTORY_SEPARATOR;
        $path = storage_path() . $ds . 'app' . $ds . 'backups' . $ds . $model->name;
        if (file_exists($path)) {
            unlink($path);
        }
        $model->delete();
        return redirect()->back()->with('message', 'Backup Deleted Successfully');
    }
}
