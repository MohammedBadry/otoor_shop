<?php

namespace App\Console\Commands\Generators;

use Illuminate\Support\Str;
use App\Console\Commands\CrudGenerator;
use App\Console\Commands\CrudMakeCommand;

class Request extends CrudGenerator
{
    public static function generate(CrudMakeCommand $command)
    {
        $name = Str::of($command->argument('name'))->singular()->studly();

        $translatable = $command->option('translatable');

        $namespace = Str::of($name)->plural()->studly();

        $stub = $translatable
            ? __DIR__.'/../stubs/Requests/TranslatableRequest.stub'
            : __DIR__.'/../stubs/Requests/Request.stub';

        static::put(
            app_path("Http/Requests/{$namespace}"),
            $name.'Request.php',
            self::qualifyContent(
                $stub,
                $name
            )
        );
    }
}
