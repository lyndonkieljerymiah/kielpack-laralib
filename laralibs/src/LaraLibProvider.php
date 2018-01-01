<?php

namespace LaraLibs;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class LaraLibProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . "/Selections/migrations" => base_path("database/migrations")
        ]);


        
        $this->loadHelpers();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        
        $this->app->bind('bundle','LaraLibs\Supports\Bundle');
        $this->app->bind('result','LaraLibs\Supports\Result');
        $this->app->bind('fileManager','LaraLibs\Supports\FileManager');
        $this->app->bind('eventListenerRegister','LaraLibs\Supports\EventListenerRegister');

        
        //auto register
        $loader = AliasLoader::getInstance();
        $loader->alias('Bundle','LaraLibs\Supports\Facades\Bundle');
        $loader->alias('EventListenerRegister','LaraLibs\Supports\Facades\EventListenerRegister');
        $loader->alias('FileManager','LaraLibs\Supports\Facades\FileManager');
        $loader->alias('Result','LaraLibs\Supports\Facades\Result');
    }



    public function loadHelpers() {
        $filename = glob(__DIR__.'\Helpers\Functions.php');
        
        require_once $filename[0];
    }
}
