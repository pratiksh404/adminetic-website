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
        if ($this->confirm('Do you wish to seed module permission?')) {
            Artisan::call('adminetic:website-permission');
        }
        if ($this->confirm('Do you wish to publish migration file?')) {
            Artisan::call('vendor:publish', ['--tag' => 'website-migrations']);
        } else {
            $this->info('Please turn off publish_migrations option in config/website');
            $this->info('Then run 1: (composer dump-autoload) 2: (php artisan migrate)');
        }
        $this->info('Adminetic website permission seeded ... ✅');
        Artisan::call('vendor:publish', [
            '--tag' => ['website-config'],
        ]);
        if ($this->confirm('Do you wish to publish view table?')) {
            Artisan::call('vendor:publish', ['--provider' => 'CyrildeWit\EloquentViewable\EloquentViewableServiceProvider', '--tag' => 'migrations']);
        }
        Artisan::call('vendor:publish', ['--provider' => 'Spatie\Analytics\AnalyticsServiceProvider']);
        $this->info('Adminetic website config file published ... ✅');
        Artisan::call('install:adminetic-category');
        $this->info('Adminetic category installed ... ✅');
        if ($this->confirm('Do you wish to run website table migration?')) {
            Artisan::call('migrate:adminetic-website');
        }
        $this->info('Adminetic website module migration complete ... ✅');
        $this->info('Adminetic Website Installed.');
        $this->info('Star to the admenictic repo would be appreciated.');
    }
}
