<?php 

namespace Mekadalibrahem\Toolkit\Console ;

use Illuminate\Filesystem\Filesystem;

trait InstallAbstractStack 
{
    /**
     * install abstract . default stack 
     */
    public function installAbstarctStack()
    {

        // Requests
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Requests'));
        (new Filesystem)->copyDirectory(__DIR__ ."/../../stubs/abstract/app/Http/Requests",app_path('Http/Requests'));

        // Controllers...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/abstract/app/Http/Controllers', app_path('Http/Controllers'));
    }
}