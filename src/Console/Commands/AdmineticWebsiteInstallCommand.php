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
        $this->info('Adminetic website permission seeded ... ✅');
        if ($this->confirm('Do you wish to publish migration file?')) {
            Artisan::call('vendor:publish', ['--tag' => 'website-migrations']);
        }
        Artisan::call('vendor:publish', ['--tag' => 'website-assets']);
        $this->info('Adminetic website assets published ... ✅');
        Artisan::call('vendor:publish', ['--tag' => 'website-modules']);
        $this->info('Adminetic website module published ... ✅');
        Artisan::call('vendor:publish', [
            '--tag' => ['website-config'],
        ]);
        Artisan::call('vendor:publish', [
            '--provider' => ['Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider'],
            '--tag' => ['livewire-tables-config'],
        ]);
        $this->info('Adminetic website config file published ... ✅');

        if ($this->confirm('Do you wish to run website table migration?')) {
            Artisan::call('migrate');
            Artisan::call('migrate:adminetic-website');
        }
        $this->info('Adminetic website module migration complete ... ✅');
        $this->info('Adminetic Website Installed.');
        $this->info('Star to the admenictic repo would be appreciated.');
    }
}
