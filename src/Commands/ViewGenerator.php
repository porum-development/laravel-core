<?php

namespace DevPlace\LaravelCore\Commands;

use Illuminate\Console\Command;

class ViewGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'devplace:generate-views {model} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate views for model';

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

        $this->info('Gerando VIEWS para ' . $model);

        $file = base_path() . '/cruds/' . $model . '.json';

        if (!file_exists($file)) {
            $this->error('O arquivo não está presente na pasta "/cruds"');
            return;
        }

        $this->force = $this->option('force');

        $this->jsonFile = json_decode(file_get_contents($file));

        $viewsPath = resource_path() . '/views/admin/' . strtolower($model);

        if (!file_exists($viewsPath)) {
            mkdir($viewsPath, 0755, true);
        }

        // index.blade.php
        $views = ['index', 'show', 'edit', 'create'];

        foreach ($views as $view) {
            $filePath = $viewsPath . '/' . $view . '.blade.php';

            if ($this->createViewFile($filePath, $view)) {
                $fileContent = file_get_contents(__DIR__ . '/../resources/view_templates/' . $view . '.blade.php');
                file_put_contents($filePath, $fileContent);
            }
        }
    }

    private function createViewFile($path, $view): bool
    {
        // drop existing file if needed
        if (file_exists($path)) {
            if (!$this->force && !$this->confirm('A view ' . $view . ' já existe, deseja sobrescrever?')) {
                return false;
            }

            unlink($path);
        }

        return true;
    }
}

