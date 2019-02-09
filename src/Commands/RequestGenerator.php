<?php

namespace DevPlace\LaravelCore\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RequestGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'devplace:generate-requests {model} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera os request de insert e update baseado em um model';

    protected $jsonFile = '';

    protected $requestStorePath = '';

    protected $requestUpdatePath = '';

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

        $this->info('Gerando REQUEST para ' . $model);

        $file = base_path() . '/cruds/' . $model . '.json';

        if (!file_exists($file)) {
            $this->error('O arquivo não está presente na pasta "/cruds"');
            return;
        }

        $this->force = $this->option('force');

        $this->jsonFile = json_decode(file_get_contents($file));

        $this->requestStorePath = base_path() . '/app/Http/Requests/Web/Store' . $model . 'Request.php';
        $this->requestUpdatePath = base_path() . '/app/Http/Requests/Web/Update' . $model . 'Request.php';

        $this->createRequestFor('Store', $model);
        $this->createRequestFor('Update', $model);
    }

    private function createRequestFor($type, $model)
    {
        // get real path request
        $requestPath = $type == 'Update' ? $this->requestUpdatePath : $this->requestStorePath;

        // drop existing file if needed
        if (file_exists($requestPath)) {
            if (!$this->force && !$this->confirm('A request de ' . $type . ' já existe, deseja sobrescrever?')) {
                return;
            }

            unlink($requestPath);
        }

        // call artisan request
        Artisan::call('make:request', [
            'name' => 'Web/' . $type . $model . 'Request'
        ]);

        // read file request
        $fileStringed = file_get_contents($requestPath);

        // replace return false to policy
        $replace = sprintf("return Auth::user()->can('create', %s::class);", $model);
        if ($type == 'Update') {
            $replace = sprintf("return Auth::user()->can('update', \$this->%s);", strtolower($model));
        }
        $fileStringed = str_replace('return false;', $replace, $fileStringed);

        // add Auth facade
        $replace = sprintf("\\FormRequest;%suse Illuminate\\Support\\Facades\\Auth;", PHP_EOL);
        $fileStringed = str_replace('\\FormRequest;', $replace, $fileStringed);

        // add use model
        $replace = sprintf("\\FormRequest;%suse App\\Models\\%s;", PHP_EOL, $model);
        $fileStringed = str_replace('\\FormRequest;', $replace, $fileStringed);

        // add validations
        if (isset($this->jsonFile->fields)) {
            $rules = [];
            foreach ($this->jsonFile->fields as $field) {
                if (($type == 'Update' && !$field->onEditForm) || ($type == 'Store' && !$field->onCreateForm)) {
                    continue;
                }
                $rules[$field->name] = $type == 'Update' ? $field->rulesOnUpdate : $field->rulesOnInsert;
            }

            $stringRules = '';
            foreach ($rules as $field => $rule) {
                $stringRules .= sprintf("            '%s' => '%s',%s", $field, $rule, PHP_EOL);
            }

            $fileStringed = preg_replace('/\/\//', $stringRules, $fileStringed, 1);
        }

        // replace file content
        file_put_contents($requestPath, $fileStringed);
    }

}

