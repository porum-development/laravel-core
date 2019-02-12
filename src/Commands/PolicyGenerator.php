<?php

declare(strict_types=1);

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
            '--model' => 'Models/' . $model,
        ]);

        // read file policy
        $this->createEnums($model);

        $fileStringed = file_get_contents($this->policyPath);

        // replace return false to policy
        $replace = sprintf("\\HandlesAuthorization;%suse App\Enums\EPermissionSlug;%suse App\Enums\ERole;", PHP_EOL, PHP_EOL);
        $fileStringed = str_replace('\\HandlesAuthorization;', $replace, $fileStringed);

        // add root before authorization
        $replace = 'use HandlesAuthorization;
        
    public function before($user, $ability)
    {
        return $user->role_id == ERole::ROOT;
    }';
        $fileStringed = str_replace('use HandlesAuthorization;', $replace, $fileStringed);

        // add actions on each
        $actions = ['SHOW', 'STORE', 'UPDATE', 'DESTROY', 'UPDATE', 'DESTROY'];

        foreach ($actions as $action) {
            $replace = sprintf("return \$user->role->permissions()->where('slug', EPermissionSlug::%s_%s)->exists();", strtoupper($model), $action);
            $fileStringed = preg_replace('/\/\//', $replace, $fileStringed, 1);
        }

        // replace file content
        file_put_contents($this->policyPath, $fileStringed);

        $this->addPolicyOnAuthProvider($model);
    }

    private function createEnums($model): void
    {
        $filePath = base_path() . '/app/Enums';
        $fileName = 'EPermissionSlug.php';

        if (!file_exists($filePath)) {
            mkdir($filePath, 0755, true);
        }

        if (!file_exists($filePath . '/' . $fileName)) {
            file_put_contents($filePath . '/' . $fileName, "<?php

declare(strict_types=1);

namespace App\Enums;

abstract class EPermissionSlug
{
}
");
        }

        $permissions = ['STORE', 'UPDATE', 'SHOW', 'DESTROY'];

        $fileContent = file_get_contents($filePath . '/' . $fileName);

        foreach ($permissions as $permission) {
            $permissionConstant = strtoupper($model) . '_' . $permission;
            if (!strpos($fileContent, $permissionConstant)) {
                $fileContent = str_replace('{', sprintf("{
    const %s = '%s';", $permissionConstant, strtolower($permissionConstant)), $fileContent);
            }
        }

        file_put_contents($filePath . '/' . $fileName, $fileContent);
    }

    private function addPolicyOnAuthProvider($model): void
    {
        $filePath = base_path() . '/app/Providers/AuthServiceProvider.php';

        $fileContent = file_get_contents($filePath);

        $stringPolicy = sprintf('%s::class => %sPolicy::class', $model, $model);

        if (!strpos($fileContent, $stringPolicy)) {
            // add policy
            $fileContent = str_replace('protected $policies = [', "protected \$policies = [
        $stringPolicy,", $fileContent);

            // add use model
            $stringUse = PHP_EOL . 'use App\\Models\\' . $model . ';' . PHP_EOL . 'use App\\Policies\\' . $model . 'Policy;';
            $fileContent = str_replace('
class AuthServiceProvider extends ServiceProvider', "$stringUse
            
class AuthServiceProvider extends ServiceProvider", $fileContent);

            // save file
            file_put_contents($filePath, $fileContent);
        }
    }
}
