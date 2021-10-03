<?php

namespace Adminetic\Website\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AdmineticWebsitePermissionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'adminetic:website-permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create website module permission flags.';

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
        Artisan::call('make:permission Client --all');
        $this->info('Client Module Permission Created ... ✅');
        Artisan::call('make:permission Counter --all');
        $this->info('Counter Module Permission Created ... ✅');
        Artisan::call('make:permission Facility --all');
        $this->info('Facility Module Permission Created ... ✅');
        Artisan::call('make:permission Faq --all');
        $this->info('Faq Module Permission Created ... ✅');
        Artisan::call('make:permission Gallery --all');
        $this->info('Gallery Module Permission Created ... ✅');
        Artisan::call('make:permission Image --all');
        $this->info('Image Module Permission Created ... ✅');
        Artisan::call('make:permission Package --all');
        $this->info('Package Module Permission Created ... ✅');
        Artisan::call('make:permission Page --all');
        $this->info('Page Module Permission Created ... ✅');
        Artisan::call('make:permission Project --all');
        $this->info('Project Module Permission Created ... ✅');
        Artisan::call('make:permission Service --all');
        $this->info('Service Module Permission Created ... ✅');
        Artisan::call('make:permission Team --all');
        $this->info('Team Module Permission Created ... ✅');
        Artisan::call('make:permission Video --all');
        $this->info('Video Module Permission Created ... ✅');
        $this->info('Star to the admenictic repo would be appreciated.');
    }
}
