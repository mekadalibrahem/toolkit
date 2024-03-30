<?php

namespace Mekadalibrahem\Toolkit\Console ;

use Illuminate\Filesystem\Filesystem;


trait InstallLivewireStack
{

    public const STUBS = __DIR__."/../../stubs/livewire";
    /**
     * install balde  stack
     */
    public function installLivewireStack()
    {
        
        $this->components->info('Start install Blade stack ');
        $this->components->info('Start install required composer packages ');
        $this->requireComposerPackages(["jenssegers/agent:^2.6"]);
        $this->components->info('End install required composer packages ');


        $this->installServiceProviderAfter('RouteServiceProvider' , 'Jenssegers\Agent\AgentServiceProvider');
         // Configure Session...
         $this->configureSession();




        // NPM Packages...
        $this->updateNodePackages(function ($packages) {
            return [
                'autoprefixer' => '^10.4.18',
                'postcss' => '^8.4.35',
                'tailwindcss' => '^3.4.1',
                'flowbite' => '^2.3.0' ,
                "alpinejs"=> "^3.13.7",
            ] + $packages;
        });
        $this->components->info('Start Extracting files .... ');
        //images
        (new Filesystem)->copyDirectory( InstallLivewireStack::STUBS  .'/public/images' , base_path('public/images'));
        // Requests
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Requests'));
        (new Filesystem)->copyDirectory(InstallLivewireStack::STUBS . "/app/Http/Requests",app_path('Http/Requests'));

        // Controllers...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers'));
        (new Filesystem)->copyDirectory(InstallLivewireStack::STUBS .'/app/Http/Controllers', app_path('Http/Controllers'));

        // Views...
        (new Filesystem)->ensureDirectoryExists(resource_path('views'));
        (new Filesystem)->copyDirectory(InstallLivewireStack::STUBS .'/resources/views', resource_path('views'));

        // Components...
        (new Filesystem)->ensureDirectoryExists(app_path('View/Components'));
        (new Filesystem)->copyDirectory(InstallLivewireStack::STUBS .'/app/View/Components', app_path('View/Components'));

        // Routes...
        copy(InstallLivewireStack::STUBS .'/routes/web.php', base_path('routes/web.php'));
        (new Filesystem)->copyDirectory(InstallLivewireStack::STUBS .'/routes/web', base_path('routes/web'));

        // Tailwind / Vite...
        copy(InstallLivewireStack::STUBS .'/tailwind.config.js', base_path('tailwind.config.js'));
        copy(InstallLivewireStack::STUBS .'/postcss.config.js', base_path('postcss.config.js'));
        copy(InstallLivewireStack::STUBS .'/vite.config.js', base_path('vite.config.js'));
        copy(InstallLivewireStack::STUBS .'/resources/css/app.css', resource_path('css/app.css'));
        copy(InstallLivewireStack::STUBS .'/resources/js/app.js', resource_path('js/app.js'));


        $this->components->info('End Extracting files  ');
       

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
