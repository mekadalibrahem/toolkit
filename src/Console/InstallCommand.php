<?php 

namespace Mekadalibrahem\Toolkit\Console ;

use Illuminate\Console\Command ;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Filesystem\Filesystem;
use RuntimeException;
use Symfony\Component\Process\Process;

use function Laravel\Prompts\select;

class InstallCommand extends Command  implements PromptsForMissingInput
{
    use InstallAbstractStack ; use InstallBladeStack ;


    protected $signature = "toolkit:install {stack : The development stack that should be installed (abstract , blade)}" ;

    protected $description = "Install the Tool kit package" ;

    public function handle() 
    {
        $this->info('start install tool kit ');
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
                    'abstract' => 'abstract... provide controllers , requests and other without front end sections or routes' ,
                    'blade' => 'blade... provide controllers .. Route , views (tailwindcss and flowbit lib ) sampile GUI'
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

      /**
     * Run the given commands.
     *
     * @param  array  $commands
     * @return void
     */
    protected function runCommands($commands)
    {
        $process = Process::fromShellCommandline(implode(' && ', $commands), null, null, null, null);

        if ('\\' !== DIRECTORY_SEPARATOR && file_exists('/dev/tty') && is_readable('/dev/tty')) {
            try {
                $process->setTty(true);
            } catch (RuntimeException $e) {
                $this->output->writeln('  <bg=yellow;fg=black> WARN </> '.$e->getMessage().PHP_EOL);
            }
        }

        $process->run(function ($type, $line) {
            $this->output->write('    '.$line);
        });
    }



}
