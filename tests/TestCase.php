<?php

namespace  Mekadalibrahem\Toolkit\Tests ;

use Mekadalibrahem\Toolkit\ToolkitServiceProvider ;
class TestCase extends \Orchestra\Testbench\TestCase
{
  public function setUp(): void
  {
    parent::setUp();
    // additional setup
  }

  protected function getPackageProviders($app)
  {
    return [
      ToolkitServiceProvider::class,
    ];
  }

  protected function getEnvironmentSetUp($app)
  {
    // perform environment setup
  }
}
