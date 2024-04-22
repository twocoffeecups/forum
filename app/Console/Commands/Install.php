<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forum:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set up and installation a forum.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('migrate', ['--seed' => true]);
    }
}
