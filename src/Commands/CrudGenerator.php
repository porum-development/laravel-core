<?php

namespace DevPlace\LaravelCore\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'devplace:generate-crud {model} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera Model, Controller, Policy, Requests e Service a partir de um Model.json';

    protected $jsonFile = '';

    protected $controllerPath = '';

    protected $requestStorePath = '';

    protected $requestUpdatePath = '';

    protected $policyPath = '';

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

        $this->info('Gerando CRUD para ' . $model);

        $file = base_path() . '/cruds/' . $model . '.json';

        if (!file_exists($file)) {
            $this->error('O arquivo não está presente na pasta "/cruds"');
            return;
        }

        $this->force = $this->option('force');

        if ($this->force || $this->confirm('Deseja gerar as Requests?', true)) {
            $this->generateRequests($model);
        }

        if ($this->force || $this->confirm('Deseja gerar o Controller?', true)) {
            $this->generateController($model);
        }

        if ($this->force || $this->confirm('Deseja gerar a Policy?', true)) {
            $this->generatePolicy($model);
        }

        if ($this->force || $this->confirm('Deseja gerar o Service?', true)) {
            $this->generateService($model);
        }

        if ($this->force || $this->confirm('Deseja gerar as Routes?', true)) {
            $this->generateRoutes($model);
        }

        $this->info('Arquivos gerados com sucesso');
    }

    private function generateRequests($model)
    {
        Artisan::call('devplace:generate-requests', [
            'model' => $model,
            '--force' => $this->force
        ], $this->getOutput());
    }

    private function generateController($model)
    {
        Artisan::call('devplace:generate-controller', [
            'model' => $model,
            '--force' => $this->force
        ], $this->getOutput());
    }

    private function generatePolicy($model)
    {
        Artisan::call('devplace:generate-policy', [
            'model' => $model,
            '--force' => $this->force
        ], $this->getOutput());
    }

    private function generateService($model)
    {
        Artisan::call('devplace:generate-service', [
            'model' => $model,
            '--force' => $this->force
        ], $this->getOutput());
    }

    private function generateRoutes($model)
    {
        Artisan::call('devplace:generate-routes', [
            'model' => $model
        ], $this->getOutput());
    }
}

