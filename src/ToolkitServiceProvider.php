<?php 
namespace Mekadalibrahem\Toolkit ;

use Illuminate\Support\ServiceProvider ;

class ToolkitServiceProvider extends ServiceProvider 
{
    
    public function register()
    {
        // 
    }


    public function boot()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            Console\InstallCommand::class,
        ]);
    }

    
}