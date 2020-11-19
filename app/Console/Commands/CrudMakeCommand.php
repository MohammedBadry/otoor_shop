<?php

namespace App\Console\Commands;

use App\Console\Commands\Generators\Breadcrumb;
use App\Console\Commands\Generators\Factory;
use App\Console\Commands\Generators\Filter;
use App\Console\Commands\Generators\Lang;
use App\Console\Commands\Generators\Migration;
use App\Console\Commands\Generators\Model;
use App\Console\Commands\Generators\Policy;
use App\Console\Commands\Generators\Resource;
use App\Console\Commands\Generators\Request;
use App\Console\Commands\Generators\View;
use Illuminate\Console\Command;
use App\Console\Commands\Generators\Controller;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CrudMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud 
                            {name : Class (Singular), e.g User, Place, Car}
                            {--translatable}
                            {--has-media}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create all Crud operations with a single command';

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
        $name = $this->argument('name');

        $controllerNamespace = '\App\Http\Controllers\\'.Str::of($name)->plural()->studly();

        $controllerName = Str::of($name)->singular()->studly().'Controller';

        $resource = Str::of($name)->plural()->snake();

        $this->info("\nIn 'routes/dashboard.php' file add:");
        $this->line("Route::resource('$resource', {$controllerNamespace}\Dashboard\\$controllerName::class);", 'bg=yellow;options=bold');

        $this->info("\nIn 'routes/api.php' file add:");
        $this->line("Route::apiResource('$resource', {$controllerNamespace}\Api\\$controllerName::class);\nRoute::get('/select/$resource', [{$controllerNamespace}\SelectController::class, 'index'])->name('{$resource}.select');", 'bg=yellow;options=bold');

        $this->info("In 'resources/views/layouts/sidebar.blade.php' file add:");
        $this->line("@include('dashboard.$resource.partials.actions.sidebar')", 'bg=yellow;options=bold');

        Breadcrumb::generate($this);
        View::generate($this);
        Resource::generate($this);
        Lang::generate($this);
        Migration::generate($this);
        Factory::generate($this);
        Policy::generate($this);
        Controller::generate($this);
        Model::generate($this);
        Request::generate($this);
        Filter::generate($this);

        $this->info('Api Crud for '.$name.' created successfully 🎉');
    }
}
