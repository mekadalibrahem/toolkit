<?php 

namespace Mekadalibrahem\Toolkit\Console ;

use Illuminate\Filesystem\Filesystem;

trait InstallBladeStack 
{

    
    /**
     * install balde  stack 
     */
    public function installBladeStack()
    {

         // NPM Packages...
         $this->updateNodePackages(function ($packages) {
            return [
                'autoprefixer' => '^10.4.18',
                'postcss' => '^8.4.35',
                'tailwindcss' => '^3.4.1',
                'flowbite' => '^2.3.0' ,
            ] + $packages;
        });
        // Requests
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Requests'));
        (new Filesystem)->copyDirectory(__DIR__ ."/../../stubs/blade/app/Http/Requests",app_path('Http/Requests'));

        // Controllers...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/blade/app/Http/Controllers', app_path('Http/Controllers'));
    }
}