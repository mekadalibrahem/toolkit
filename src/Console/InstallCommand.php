<?php 

namespace Mekadalibrahem\Toolkit\Console ;

use Illuminate\Console\Command ;
use Illuminate\Contracts\Console\PromptsForMissingInput;

use function Laravel\Prompts\select;

class InstallCommand extends Command  implements PromptsForMissingInput
{
    use InstallAbstractStack ;


    protected $signature = "toolkit:install {stack : The development stack that should be installed (abstract)}" ;

    protected $description = "Install the Tool kit package" ;

    public function handle() 
    {
        if ($this->argument('stack') === 'abstract') {
            return $this->installAbstarctStack() ;
        }
        $this->components->error('Invalid stack. Supported stacks are [abstract]');

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
                    'abstract' => 'with  out view or GUI'

                ],
                scroll: 1,
            ),
        ];
    }

}
