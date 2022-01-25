<?php

namespace Astrogoat\Gtm\Commands;

use Illuminate\Console\Command;

class GtmCommand extends Command
{
    public $signature = 'gtm';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
