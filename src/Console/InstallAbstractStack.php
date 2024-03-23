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
         // Controllers...
         (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers'));
         (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/default/app/Http/Controllers', app_path('Http/Controllers'));
    }
}