<?php 
namespace Mekadalibrahem\Toolkit\Tests\Unit ;

use Illuminate\Support\Facades\Artisan;
use Mekadalibrahem\Toolkit\Tests\TestCase;
use Illuminate\Support\Facades\File ;
class InstallLivewireStackTest extends TestCase 
{
    public function test_install_command_livewire()
    {
        $this->assertEquals( 
            Artisan::call('toolkit:install livewire') 
            ,0
        );
        $this->assertTrue(File::exists(app_path('Livewire/Profile/Info.php')));
        $this->assertTrue(File::exists(resource_path('views/livewire/profile/info.blade.php')));
        $this->assertTrue(File::exists(base_path('public/images/toolkit_logo_dark.png')));
        $this->assertTrue(File::exists(app_path('Http/Controllers/Auth')));
        $this->assertTrue(File::exists(app_path('Http/Requests/Auth')));
        $this->assertTrue(File::exists(app_path('View/Components/Alert/Alert.php')));
        $this->assertTrue(File::exists(base_path('tailwind.config.js')));
        $this->assertTrue(File::exists(base_path('postcss.config.js')));
        $this->assertTrue(File::exists(base_path('vite.config.js')));
        $this->assertTrue(File::exists(resource_path('css/app.css')));
        $this->assertTrue(File::exists(resource_path('js/app.js')));
        
       
    }

}



