<?php 

namespace Mekadalibrahem\Toolkit\Console ;

use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

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

        // Views...
        (new Filesystem)->ensureDirectoryExists(resource_path('views'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/blade/resources/views', resource_path('views'));

        // Components...
        (new Filesystem)->ensureDirectoryExists(app_path('View/Components'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/blade/app/View/Components', app_path('View/Components'));

        // Routes...
        copy(__DIR__.'/../../stubs/blade/routes/web.php', base_path('routes/web.php'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/blade/routes/web', base_path('routes/web'));

        // Tailwind / Vite...
        copy(__DIR__.'/../../stubs/blade/tailwind.config.js', base_path('tailwind.config.js'));
        copy(__DIR__.'/../../stubs/blade/postcss.config.js', base_path('postcss.config.js'));
        copy(__DIR__.'/../../stubs/blade/vite.config.js', base_path('vite.config.js'));
        copy(__DIR__.'/../../stubs/blade/resources/css/app.css', resource_path('css/app.css'));
        copy(__DIR__.'/../../stubs/blade/resources/js/app.js', resource_path('js/app.js'));

        $this->components->info('Installing and building Node dependencies.');

        if (file_exists(base_path('pnpm-lock.yaml'))) {
            $this->runCommands(['pnpm install', 'pnpm run build']);
        } elseif (file_exists(base_path('yarn.lock'))) {
            $this->runCommands(['yarn install', 'yarn run build']);
        } else {
            $this->runCommands(['npm install', 'npm run build']);
        }
    
        $this->line('');
        $this->components->info('toolkit  installed successfully.');
    }

   
}