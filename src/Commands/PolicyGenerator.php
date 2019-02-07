<?php

namespace DevPlace\LaravelCore\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class PolicyGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'devplace:generate-policy {model} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera uma policy a partir de um model';

    protected $jsonFile = '';

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

        $this->info('Gerando POLICY para ' . $model);

        $file = base_path() . '/cruds/' . $model . '.json';

        if (!file_exists($file)) {
            $this->error('O arquivo não está presente na pasta "/cruds"');
            return;
        }

        $this->force = $this->option('force');

        $this->policyPath = base_path() . '/app/Policies/' . $model . 'Policy.php';

        if (file_exists($this->policyPath)) {
            if (!$this->force && !$this->confirm('A Policy já existe, deseja sobrescrever?')) {
                return;
            }

            unlink($this->policyPath);
        }

        Artisan::call('make:policy', [
            'name' => $model . 'Policy',
            '--model' => 'Models/' . $model
        ]);

        // read file policy
        $fileStringed = file_get_contents($this->policyPath);

        // replace return false to policy
        $replace = sprintf("\\HandlesAuthorization;%suse App\Enums\EPermissionSlug;%suse App\Enums\ERole;", PHP_EOL, PHP_EOL);
        $fileStringed = str_replace('\\HandlesAuthorization;', $replace, $fileStringed);

        // add root before authorization
        $replace = "use HandlesAuthorization;
        
    public function before(\$user, \$ability)
    {
        return \$user->role_id == ERole::ROOT;
    }";
        $fileStringed = str_replace('use HandlesAuthorization;', $replace, $fileStringed);

        // add actions on each
        $actions = ['SHOW', 'STORE', 'UPDATE', 'DESTROY'];

        foreach ($actions as $action) {
            $replace = sprintf("return \$user->role->permissions()->where('slug', EPermissionSlug::%s_%s)->exists();", strtoupper($model), $action);
            $fileStringed = preg_replace('/\/\//', $replace, $fileStringed, 1);
        }

        // replace file content
        file_put_contents($this->policyPath, $fileStringed);
    }
}
