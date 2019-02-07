<?php

namespace DevPlace\LaravelCore\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RouteGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'devplace:generate-routes {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera as rotas de resource baseado em um model';

    protected $jsonFile = '';

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

        $this->info('Gerando ROTAS para ' . $model);

        $file = base_path() . '/cruds/' . $model . '.json';

        if (!file_exists($file)) {
            $this->error('O arquivo não está presente na pasta "/cruds"');
            return;
        }

        $this->jsonFile = json_decode(file_get_contents($file));

        // get real path request
        $routePath = base_path() . '/routes/web.php';

        $routeFile = file_get_contents($routePath);

        $group = "Route::prefix('admin')->namespace('Admin')->as('admin.')->middleware(['verified', 'auth:web'])->group(function () {";

        if (!strpos($routeFile, $group)) {
            $routeFile .= PHP_EOL . $group . PHP_EOL . '});';
        };

        $replace = $group . PHP_EOL . sprintf("    Route::resource('%s', '%sController');", strtolower($model), $model);
        $routeFile = str_replace($group, $replace, $routeFile);

        file_put_contents($routePath, $routeFile);

    }
}

