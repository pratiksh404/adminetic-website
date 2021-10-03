<?php

namespace Adminetic\Website\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AdmineticWebsiteInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:adminetic-website';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to install adminetic website module.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->confirm('Do you wish to seed module permission? (y/n)')) {
            Artisan::call('adminetic:website-permission');
        }
        Artisan::call('install:adminetic-category');
        $this->info('Star to the admenictic repo would be appreciated.');
    }
}
