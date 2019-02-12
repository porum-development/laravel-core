<?php

declare(strict_types=1);

namespace DevPlace\LaravelCore\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ControllerGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'devplace:generate-controller {model} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera um controller a partir de um model';

    protected $jsonFile = '';

    protected $controllerPath = '';

    protected $requestStorePath = '';

    protected $requestUpdatePath = '';

    protected $force = false;

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

        $this->info('Gerando CONTROLLERS para ' . $model);

        $file = base_path() . '/cruds/' . $model . '.json';

        if (!file_exists($file)) {
            $this->error('O arquivo não está presente na pasta "/cruds"');

            return;
        }

        $this->force = $this->option('force');

        $this->jsonFile = json_decode(file_get_contents($file));

        $this->controllerPath = base_path() . '/app/Http/Controllers/Web/Admin/' . $model . 'Controller.php';
        $this->requestStorePath = base_path() . '/app/Http/Requests/Web/Store' . $model . 'Request.php';
        $this->requestUpdatePath = base_path() . '/app/Http/Requests/Web/Update' . $model . 'Request.php';

        if (file_exists($this->controllerPath)) {
            if (!$this->force && !$this->confirm('O Controller já existe, deseja sobrescrever?')) {
                return;
            }

            unlink($this->controllerPath);
        }

        Artisan::call('make:controller', [
            'name' => 'Web/Admin/' . $model . 'Controller',
            '--model' => 'Models/' . $model,
            '-r' => true,
        ]);

        //read the entire string
        $fileStringed = file_get_contents($this->controllerPath);

        // service layer
        $fileStringed = $this->insertServiceLayer($model, $fileStringed);

        // replace requests
        $fileStringed = $this->replaceRequests($model, $fileStringed);

        // add code on index method
        $fileStringed = $this->indexMethod($model, $fileStringed);

        // add code on create method
        $fileStringed = $this->createMethod($model, $fileStringed);

        // add code on store method
        $fileStringed = $this->storeMethod($model, $fileStringed);

        // add code on show method
        $fileStringed = $this->showMethod($model, $fileStringed);

        // add code on edit method
        $fileStringed = $this->editMethod($model, $fileStringed);

        // add code on update method
        $fileStringed = $this->updateMethod($model, $fileStringed);

        // add code on update method
        $fileStringed = $this->destroyMethod($model, $fileStringed);

        //write the entire string
        file_put_contents($this->controllerPath, $fileStringed);
    }

    private function insertServiceLayer($model, $fileStringed)
    {
        // use UserService;
        $fileStringed = str_replace('\\Controller;', '\\Controller;' . PHP_EOL . 'use App\\Services\\' . $model . 'Service;', $fileStringed);

        // insert constructor
        $string = "Controller
{
    protected \$%sService;
    protected \$params;

    public function __construct(%sService \$%sService)
    {
        \$this->%sService = \$%sService;
        \$this->params = json_decode(file_get_contents(base_path() . '/cruds/%s.json'));
    }
    ";

        $replace = sprintf($string, strtolower($model), $model, strtolower($model), strtolower($model), strtolower($model), $model);

        return str_replace('Controller
{', $replace, $fileStringed);
    }

    private function replaceRequests($model, $fileStringed)
    {
        if (file_exists($this->requestStorePath)) {
            $fileStringed = str_replace('\\Controller;', '\\Controller;' . PHP_EOL . 'use App\\Http\\Requests\\Web\\Store' . $model . 'Request;', $fileStringed);
            $fileStringed = str_replace('public function store(Request', 'public function store(Store' . $model . 'Request', $fileStringed);
        }

        if (file_exists($this->requestUpdatePath)) {
            $fileStringed = str_replace('\\Controller;', '\\Controller;' . PHP_EOL . 'use App\\Http\\Requests\\Web\\Update' . $model . 'Request;', $fileStringed);
            $fileStringed = str_replace('public function update(Request', 'public function update(Update' . $model . 'Request', $fileStringed);
        }

        return $fileStringed;
    }

    private function indexMethod($model, $fileStringed)
    {
        $replace = sprintf("\$this->authorize('view', %s::class);
        
        \$records = %s::paginate();

        \$params = \$this->params;
        
        \$breadcrumb = [
            ['name' => '%ss', 'route' => null]
        ];
        
        return view('admin.%s.index', compact('records', 'params', 'breadcrumb'));", $model, $model, $model, strtolower($model));

        return preg_replace('/\/\//', $replace, $fileStringed, 1);
    }

    private function createMethod($model, $fileStringed)
    {
        $replace = sprintf("\$this->authorize('create', %s::class);
        
        \$params = \$this->params;
        
        \$breadcrumb = [
            ['name' => '%ss', 'route' => route('admin.%s.index', request()->getLocale())],
            ['name' => 'Creating %s', 'route' => null]
        ];

        \$vars = [
            'params' => \$params,
            'breadcrumb' => \$breadcrumb
        ];

        foreach (\$params->fields as \$field) {
            if (\$field->type == 'relation') {
                \$class = \"App\\\\\\\\Models\\\\\\\\{\$field->options->model}\";
                if (class_exists(\$class)) {
                    \$vars[\$field->options->on] = \$class::pluck(\$field->options->display, \$field->options->references);
                }
            }
        }
        
        return view('admin.%s.create', \$vars);", $model, $model, strtolower($model), $model, strtolower($model));

        return preg_replace('/\/\//', $replace, $fileStringed, 1);
    }

    private function storeMethod($model, $fileStringed)
    {
        $lowerModel = strtolower($model);

        $replace = sprintf("\$this->authorize('create', %s::class);
        
        try {
            \$inserted = \$this->%sService->store(\$request->validated());
        } catch (\Exception \$e) {
            flash()->error(__('There was an error creating the %s'));
            return redirect()->back()->withInput(\$request->all());
        }

        flash()->success(__('%s successful inserted'));
        return redirect()->route('admin.%s.show', [\$request->getLocale(), \$inserted]);", $model, $lowerModel, $lowerModel, $model, $lowerModel);

        return preg_replace('/\/\//', $replace, $fileStringed, 1);
    }

    private function showMethod($model, $fileStringed)
    {
        $lowerModel = strtolower($model);

        $replace = sprintf("\$this->authorize('view', $%s);
        
        \$params = \$this->params;
        
        \$breadcrumb = [
            ['name' => '%ss', 'route' => route('admin.%s.index', request()->getLocale())],
            ['name' => '%s details', 'route' => null]
        ];

        return view('admin.%s.show', [
            'record' => \$%s,
            'params' => \$params,
            'breadcrumb' => \$breadcrumb
        ]);", $lowerModel, $model, $lowerModel, $model, $lowerModel, $lowerModel);

        return preg_replace('/\/\//', $replace, $fileStringed, 1);
    }

    private function editMethod($model, $fileStringed)
    {
        $lowerModel = strtolower($model);

        $replace = sprintf("\$this->authorize('update', $%s);
        
        \$params = \$this->params;
        
        \$breadcrumb = [
            ['name' => '%ss', 'route' => route('admin.%s.index', request()->getLocale())],
            ['name' => '%s details', 'route' => route('admin.%s.show', [request()->getLocale(), $%s])],
            ['name' => 'Editing %s', 'route' => null]
        ];

        \$vars = [
            'record' => \$%s,
            'params' => \$params,
            'breadcrumb' => \$breadcrumb
        ];

        foreach (\$params->fields as \$field) {
            if (\$field->type == 'relation') {
                \$class = \"App\\\\\\\\Models\\\\\\\\{\$field->options->model}\";
                if (class_exists(\$class)) {
                    \$vars[\$field->options->on] = \$class::pluck(\$field->options->display, \$field->options->references);
                }
            }
        }

        return view('admin.%s.edit', \$vars);", $lowerModel, $model, $lowerModel, $model, $lowerModel, $lowerModel, $model, $lowerModel, $lowerModel);

        return preg_replace('/\/\//', $replace, $fileStringed, 1);
    }

    private function updateMethod($model, $fileStringed)
    {
        $lowerModel = strtolower($model);

        $replace = sprintf("\$this->authorize('update', $%s);
        
        try {
            \$%s = \$this->%sService->update(\$%s, \$request->validated());
        } catch (\Exception \$e) {
            flash()->error(__('There was an error updating the %s'));
            return redirect()->back()->withInput(\$request->all());
        }

        flash()->success(__('%s successful updated'));
        return redirect()->route('admin.%s.show', [\$request->getLocale(), \$%s]);", $lowerModel, $lowerModel, $lowerModel, $lowerModel, $lowerModel, $model, $lowerModel, $lowerModel);

        return preg_replace('/\/\//', $replace, $fileStringed, 1);
    }

    private function destroyMethod($model, $fileStringed)
    {
        $lowerModel = strtolower($model);

        $replace = sprintf("\$this->authorize('destroy', $%s);
        
        try {
            \$this->%sService->destroy(\$%s);
        } catch (\Exception \$e) {
            flash()->error(__('There was an error creating the %s'));
            return redirect()->back();
        }

        flash()->success(__('%s successful deleted'));
        return redirect()->route('admin.%s.index');", $lowerModel, $lowerModel, $lowerModel, $lowerModel, $model, $lowerModel);

        return preg_replace('/\/\//', $replace, $fileStringed, 1);
    }
}
