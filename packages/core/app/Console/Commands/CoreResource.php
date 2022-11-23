<?php

namespace Core\Console\Commands;

use Core\Services\PackageService;
use Illuminate\Console\Command;


class CoreResource extends Command
{
    protected $signature = "generate:resource {resource} {package} {dir?}";

    protected $descritption = "Creates resource inside the package";
    /**
     * @var array|string|null
     */
    private $resource;
    /**
     * @var array|string|null
     */
    private $package;
    /**
     * @var array|string
     */
    private $dir;
    /**
     * @var string
     */
    private $stub;
    /**
     * @var string
     */
    private $upackage;

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->resource = $this->argument('resource');
        $this->package = $this->argument('package');
        $this->upackage = ucfirst($this->package);
        $this->dir = $this->argument('dir') ?? 'Api';
        $this->stub = base_path() . '/packages/core/stubs/';
        $packages = PackageService::packages();
        if(file_exists(base_path() . "/packages/$this->package")){
            $path = base_path() . "/packages/$this->package/app/Models";
        }else{
            $this->error("Package does not exist");
        }
        $this->createResource();
    }



    public function createResource()
    {
        $template = file_get_contents($this->stub . 'resource.stub');
        $variables = [
            'RESOURCE' => $this->resource,
            'PACKAGE' => $this->upackage,
            'DIR' => $this->dir
        ];
        foreach ($variables as $key => $value) {
            $template = str_replace("{{{$key}}}", $value, $template);
        }
        $path = base_path() . '/packages/' . $this->package . '/app/Resources/'. $this->dir;
        if(!file_exists($path))
        {
            mkdir($path, 0777, true);
        }
        file_put_contents($path . "/$this->resource.php", $template);
    }

    
}
