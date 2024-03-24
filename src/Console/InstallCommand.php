<?php 

namespace Mekadalibrahem\Toolkit\Console ;

use Illuminate\Console\Command ;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Filesystem\Filesystem;

use function Laravel\Prompts\select;

class InstallCommand extends Command  implements PromptsForMissingInput
{
    use InstallAbstractStack ; use InstallBladeStack ;


    protected $signature = "toolkit:install {stack : The development stack that should be installed (abstract , blade)}" ;

    protected $description = "Install the Tool kit package" ;

    public function handle() 
    {
        if ($this->argument('stack') === 'abstract') {
            return $this->installAbstarctStack() ;
        }
        if ($this->argument('stack') === 'blade'){
            return $this->installBladeStack();
        }
        $this->components->error('Invalid stack. Supported stacks are [abstract , blade]');

        return 1;
    }

    /**
     * Prompt for missing input arguments using the returned questions.
     *
     * @return array
     */
    protected function promptForMissingArgumentsUsing()
    {
        return [
            'stack' => fn () => select(
                label: 'Which toolkit stack would you like to install?',
                options: [
                    'abstract' => 'with  out view or GUI' ,
                    'blade' => 'woth ... Route , view (tailwindcss and flowbit lib )   '
                ],
                scroll: 2,
            ),
        ];
    }

    
    /**
     * Update the "package.json" file.
     *
     * @param  callable  $callback
     * @param  bool  $dev
     * @return void
     */
    protected static function updateNodePackages(callable $callback, $dev = true)
    {
        if (! file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages[$configurationKey] = $callback(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $configurationKey
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    /**
     * Delete the "node_modules" directory and remove the associated lock files.
     *
     * @return void
     */
    protected static function flushNodeModules()
    {
        tap(new Filesystem, function ($files) {
            $files->deleteDirectory(base_path('node_modules'));

            $files->delete(base_path('yarn.lock'));
            $files->delete(base_path('package-lock.json'));
        });
    }


}
