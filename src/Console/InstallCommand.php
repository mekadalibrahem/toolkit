<?php 

namespace Mekadalibrahem\Toolkit\Console ;

use Illuminate\Console\Command ;
use Illuminate\Contracts\Console\PromptsForMissingInput;

class InstallCommand extends Command  implements PromptsForMissingInput
{
    use InstallAbstractStack ;


    protected $signature = "toolkit:install {stack : The development stack that should be installed (abstarct)}" ;

    protected $description = "Install the Tool kit package" ;

    public function handel() 
    {
        if ($this->argument('stack') === 'blade') {
            return $this->installAbstarctStack() ;
        }
        $this->components->error('Invalid stack. Supported stacks are [blade]');

        return 1;
    }
}
