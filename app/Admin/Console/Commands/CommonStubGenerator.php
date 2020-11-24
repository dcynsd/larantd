<?php

namespace App\Admin\Console\Commands;

use Illuminate\Console\Command;

class CommonStubGenerator extends Command
{
    protected function getStub($type)
    {
        return file_get_contents(admin_path("/Console/Commands/stubs/$type.stub"));
    }
}
