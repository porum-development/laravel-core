<?php

namespace DevPlace\LaravelCore\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ServiceGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'devplace:generate-service {model} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate service structure';

    protected $jsonFile = '';

    protected $force = false;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $model = $this->argument('model');

        $this->info('Gerando SERVICE para ' . $model);

        $file = base_path() . '/cruds/' . $model . '.json';

        if (!file_exists($file)) {
            $this->error('O arquivo não está presente na pasta "/cruds"');
            return;
        }

        $this->force = $this->option('force');

        $this->jsonFile = json_decode(file_get_contents($file));

        $serviceDir = base_path() . '/app/Services';
        $servicePath = $serviceDir . '/' . $model . 'Service.php';

        // drop existing file if needed
        if (file_exists($servicePath)) {
            if (!$this->force && !$this->confirm('O service já existe, deseja sobrescrever?')) {
                return;
            }

            unlink($servicePath);
        }

        if (!file_exists($serviceDir)) {
            mkdir($serviceDir, 0755, true);
        }

        $lowerModel = strtolower($model);

        $fileContent = sprintf(
        "<?php
namespace App\Services;

use App\Models\%s;
use Illuminate\Http\UploadedFile;

class %sService
{
    public function store(array \$params): %s
    {
        \$files = [];
        foreach(\$params as \$key => \$param) {
            if (\$param instanceof UploadedFile) {
                \$files[\$key] = \$param;
                unset(\$params[\$key]);
            }
        }

        \$model = %s::create(\$params);

        if(!empty(\$files)) {
            foreach(\$files as \$key => \$file) {
                \$path = \$file->store('public/%s/' . \$model->id);
                \$model->{\$key} = \$path;
            }

            \$model->save();
        }

        return \$model;
    }

    public function update(%s \$model, array \$params)
    {
        return \$model->update(\$params);
    }

    public function destroy(%s \$model)
    {
        return \$model->delete();
    }
}
", $model, $model, $model, $model, $lowerModel, $model, $model);

        file_put_contents($servicePath, $fileContent);
    }
}

