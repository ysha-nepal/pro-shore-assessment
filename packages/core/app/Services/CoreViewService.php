<?php

namespace Core\Services;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\View;
use Illuminate\View\FileViewFinder;

class CoreViewService extends FileViewFinder
{
    public function __construct(Filesystem $files, array $paths, array $extensions = null)
    {
        parent::__construct($files, $paths, $extensions);
    }

    /**
     * Get the path to a template with a named path.
     *
     * @param  string  $name
     * @return string
     */
    protected function findNamespacedView($name)
    {
        [$namespace, $view] = $this->parseNamespaceSegments($name);
        $override = "packages." . $namespace . '.' . $view;
        if(View::exists($override)){
            return $this->findInPaths($override,$this->paths);
        }
        if($namespace === "log-viewer"){
            $override = "core::admin." . $namespace . '.' . $view;
            if(View::exists($override)){
                return $this->findInPaths("admin.log-viewer.".$view, $this->hints['core']);
            }
        }
        return $this->findInPaths($view, $this->hints[$namespace]);
    }
}
