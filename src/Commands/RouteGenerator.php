<?php

declare(strict_types=1);

namespace Porum\LaravelCore\Commands;

use Illuminate\Console\Command;

class RouteGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'porum:generate-routes {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera as rotas de resource baseado em um model';

    protected $jsonFile = '';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
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

        $newResource = sprintf("Route::resource('%s', '%sController');", strtolower($model), $model);

        if (strpos($routeFile, $newResource)) {
            return;
        }

        $group = "Route::prefix('admin')->namespace('Admin')->as('admin.')->middleware(['verified', 'auth:web'])->group(function () {";

        if (!strpos($routeFile, $group)) {
            $routeFile .= PHP_EOL . $group . PHP_EOL . '});';
        }

        $replace = $group . PHP_EOL . "        $newResource";
        $routeFile = str_replace($group, $replace, $routeFile);

        file_put_contents($routePath, $routeFile);
    }
}
