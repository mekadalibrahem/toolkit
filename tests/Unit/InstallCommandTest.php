<?php 
namespace Mekadalibrahem\Toolkit\Tests\Unit ;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Mekadalibrahem\Toolkit\Tests\TestCase;

class InstallCommandTest extends TestCase 
{
    

    public function test_install_command_abstarct_choice()
    {
    
        $this->assertEquals(Artisan::call('toolkit:install abstract') , 0 );

        $this->assertTrue(File::exists(app_path('Http/Controllers/Auth')));
        $this->assertTrue(File::exists(app_path("Http/Requests/Auth")));
    }
}