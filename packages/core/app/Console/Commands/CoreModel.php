<?php

namespace Core\Console\Commands;

use Core\Services\PackageService;
use Illuminate\Console\Command;


class CoreModel extends Command
{
    protected $signature = "generate:model {model} {package} {dir?}";

    protected $description = "Creates model inside the package";
    /**
     * @var array|string|null
     */
    private $model;
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
        $this->model = $this->argument('model');
        $this->package = $this->argument('package');
        $this->upackage = ucfirst($this->package);
        $this->dir = $this->argument('dir') ?? 'Admin';
        $this->stub = base_path() . '/packages/core/stubs/';
        $packages = PackageService::packages();

        if(file_exists(base_path() . "/packages/$this->package")){
            $path = base_path() . "/packages/$this->package/app/Models";

        }else{
            $this->error("Package does not exist");
        }
        $this->createModel();

        $repository = $this->confirm("Do you want to create repository ?");
        if($repository){
            $this->createRepository();
        }
        $ui = $this->confirm("Do you want to create ui ?");
        if ($ui) {
            $this->createUI();
        }
        $controller = $this->confirm("Do you want to create controller ?");
        if ($controller) {
            $this->createController();
        }
    }

    public function createModel()
    {
        $template = file_get_contents($this->stub . 'model.stub');
        $variables = [
            'MODEL' => $this->model,
            'PACKAGE' => $this->upackage,
            'DIR' => $this->dir
        ];
        foreach ($variables as $key => $value) {
            $template = str_replace("{{{$key}}}", $value, $template);
        }
        $path = base_path() . '/packages/' . $this->package . '/app/Models';

        file_put_contents($path . "/$this->model.php", $template);
    }

    public function createRepository()
    {
        $template = file_get_contents($this->stub . '/repository.stub');
        $variables = [
            'MODEL' => $this->model,
            'PACKAGE' => $this->upackage,
            'DIR' => $this->dir
        ];
        foreach ($variables as $key => $value) {
            $template = str_replace("{{{$key}}}", $value, $template);
        }
        $path = base_path() . '/packages/' . $this->package . '/app/Repositories/' . $this->dir;
        if(!is_dir($path)){
            mkdir($path);
        }
        file_put_contents($path . "/$this->model" . "Repository.php", $template);
    }

    public function createUI()
    {
        $template = file_get_contents($this->stub . '/ui.stub');
        $variables = [
            'MODEL' => $this->model,
            'PACKAGE' => $this->upackage,
            'DIR' => $this->dir
        ];
        foreach ($variables as $key => $value) {
            $template = str_replace("{{{$key}}}", $value, $template);
        }
        $path = base_path() . '/packages/' . $this->package . '/app/UI';
        file_put_contents($path . "/$this->model" . "UI.php", $template);
    }

    public function createController()
    {
        $template = file_get_contents($this->stub . '/controller.stub');
        $variables = [
            'MODEL' => $this->model,
            'PACKAGE' => $this->upackage,
            'DIR' => $this->dir,
            'PACKAGE_NAME' => $this->package
        ];
        foreach ($variables as $key => $value) {
            $template = str_replace("{{{$key}}}", $value, $template);
        }
        $path = base_path() . '/packages/' . $this->package . '/app/Controllers/' . $this->dir;
        if(!is_dir($path)){
            mkdir($path);
        }
        file_put_contents($path . "/$this->model" . "Controller.php", $template);
    }
}
