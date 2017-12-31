<?php

namespace KielPack\LaraLibs;

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

        
        $this->app->bind('bundle','KielPack\LaraLibs\Supports\Bundle');
        $this->app->bind('result','KielPack\LaraLibs\Supports\Result');
        $this->app->bind('fileManager','KielPack\LaraLibs\Supports\FileManager');
        $this->app->bind('eventListenerRegister','KielPack\LaraLibs\Supports\EventListenerRegister');
        
        //auto register
        $loader = AliasLoader::getInstance();
        $loader->alias('Bundle','KielPack\LaraLibs\Supports\Facades\Bundle');
        $loader->alias('EventListenerRegister','KielPack\LaraLibs\Supports\Facades\EventListenerRegister');
        $loader->alias('FileManager','KielPack\LaraLibs\Supports\Facades\FileManager');
        $loader->alias('Result','KielPack\LaraLibs\Supports\Facades\Result');
    }



    public function loadHelpers() {
        $filename = glob(__DIR__.'\Helpers\Functions.php');
        
        require_once $filename[0];
    }
}
