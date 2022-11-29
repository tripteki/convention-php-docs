<?php

namespace Tripteki\Docs\Providers;

use Tripteki\Docs\Console\Commands\UnGenerateDocsCommand;
use Tripteki\Docs\Console\Commands\GenerateDocsCommand;
use Illuminate\Support\ServiceProvider;

class DocsServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        $this->registerCommands();
        $this->registerPublishers();
    }

    /**
     * @return void
     */
    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {

            $this->commands(
            [
                UnGenerateDocsCommand::class,
                GenerateDocsCommand::class,
            ]);
        }
    }

    /**
     * @return void
     */
    protected function registerPublishers()
    {
        $this->publishes(
        [
            __DIR__."/../../config/swagger.php" => config_path("l5-swagger.php"),
        ],

        "tripteki-laravelphp-docs-config");

        $this->publishes(
        [
            __DIR__."/../../resources/views" => config("l5-swagger.defaults.paths.views"),
        ],

        "tripteki-laravelphp-docs-views");
    }
};
