<?php

namespace Core\Console\Commands;

use Carbon\Carbon;
use Core\Models\Backup;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CoreBackup extends Command
{
    protected $signature = "generate:backup";

    protected $description = "Backup";
    /**
     * @var Backup
     */
    private $model;

    public function __construct(Backup  $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    public function handle()
    {
        $ds = DIRECTORY_SEPARATOR;
        $path = storage_path() . $ds . 'app' . $ds . 'backups' . $ds;
        if(!is_dir($path)){
            mkdir($path);
        }
        $name = setting_helper('general-setting', 'name') ?? env('APP_NAME');
        $filename = Str::slug($name) . "_" .
            Carbon::now()->format('Y_m_d_H_i_s') .
            "_mysqldump.sql.gz";
        $command = "mysqldump -u " ;
        $filepath = $path . $filename;
        $command.= env('DB_USERNAME') . " -p'" . env('DB_PASSWORD') . "' " . env('DB_DATABASE');
        $command.= " | gzip > " . "$filepath" ;
        exec("$command 2>&1",$log);
        Log::info($log);

        $this->model->create([
            'name' => $filename,
            'size' => file_size_helper(filesize($filepath))
        ]);
    }
}
