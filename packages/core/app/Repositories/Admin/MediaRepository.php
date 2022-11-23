<?php

namespace Core\Repositories\Admin;

use Carbon\Carbon;
use Core\Models\Media;
use Core\Repositories\Common\Traits\CommonRepositoryTrait;
use Core\Repositories\Common\Traits\CrudRepositoryTrait;
use Core\Repositories\Common\Traits\SearchRepositoryTrait;
use Illuminate\Support\Facades\Auth;

class MediaRepository
{
    use CommonRepositoryTrait, CrudRepositoryTrait, SearchRepositoryTrait;

    protected $model;

    public function __construct(Media $model)
    {
        $this->model = $model;
    }

    public function store($data)
    {
        $user = Auth::user();
        foreach ($data['medias'] as $file) {
            $ext = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $name = $this->cleanName($filename, $ext, true);
            $path = storage_path() . '/app/medias/';
            $size = file_size_helper($file->getSize());

            $type = $this->getType($ext);
            if ($type) {
                $file->move($path, $name);
                $this->model->create([
                    'title' => $data['title'],
                    'name' => $name,
                    'ext' => $ext,
                    'slug' => $name,
                    'size' => $size,
                    'path' => '/medias/' . $name,
                    'type' => $type,
                    'user_id' => $user->id,
                    'description' => $data['description'] ?? ''
                ]);
            }
        }
    }

    public function cleanName($name, $ext, $trim = false)
    {
        $name = str_replace(".$ext", "", $name);
        if ($trim) {
            $name = substr($name, 0, 30);
        }
        $name = $name . "_" . Carbon::now()->format('Y_m_d_H_i_s') . "." .  strtolower(($ext));
        return preg_replace('/[^0-9a-zA-Z-_.]/', '', $name);
    }

    public function getType($ext)
    {
        foreach (config('core.medias.mimes') as $key => $types) {
            if (in_array($ext, $types)) {
                return $key;
            }
        }
        return null;
    }

    public function delete($id)
    {
        $model = $this->model->findOrFail($id);
        if (file_exists($model->storage_path)) {
            unlink($model->storage_path);
        }
        $model->delete();
    }
}
