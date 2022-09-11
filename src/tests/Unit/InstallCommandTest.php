<?php

namespace Smbplus\UserManagement\Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Smbplus\UserManagement\Tests\TestCase;

class InstallBlogPackageTest extends TestCase
{
    /** @test */
    function the_install_command_copies_the_configuration()
    {
        // make sure we're starting from a clean state
        if (File::exists(config_path('smbplus_um.php'))) {
            unlink(config_path('smbplus_um.php'));
        }

        $this->assertFalse(File::exists(config_path('smbplus_um.php')));

        Artisan::call('um:install');

        $this->assertTrue(File::exists(config_path('smbplus_um.php')));
    }
}