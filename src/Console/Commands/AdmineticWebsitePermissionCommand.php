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
        Artisan::call('make:permission Category --all');
        $this->info('Category Module Permission Created ... ✅');
        Artisan::call('make:permission Client --all');
        $this->info('Client Module Permission Created ... ✅');
        Artisan::call('make:permission Counter --all');
        $this->info('Counter Module Permission Created ... ✅');
        Artisan::call('make:permission Coupon --all');
        $this->info('Coupon Module Permission Created ... ✅');
        Artisan::call('make:permission Download --all');
        $this->info('Download Module Permission Created ... ✅');
        Artisan::call('make:permission Event --all');
        $this->info('Event Module Permission Created ... ✅');
        Artisan::call('make:permission Facility --all');
        $this->info('Facility Module Permission Created ... ✅');
        Artisan::call('make:permission Faq --all');
        $this->info('Faq Module Permission Created ... ✅');
        Artisan::call('make:permission Feature --all');
        $this->info('Feature Module Permission Created ... ✅');
        Artisan::call('make:permission Gallery --all');
        $this->info('Gallery Module Permission Created ... ✅');
        Artisan::call('make:permission Guest --all');
        $this->info('Guest Module Permission Created ... ✅');
        Artisan::call('make:permission Notice --all');
        $this->info('Notice Module Permission Created ... ✅');
        Artisan::call('make:permission Package --all');
        $this->info('Package Module Permission Created ... ✅');
        Artisan::call('make:permission Page --all');
        $this->info('Page Module Permission Created ... ✅');
        Artisan::call('make:permission Pass --all');
        $this->info('Pass Module Permission Created ... ✅');
        Artisan::call('make:permission Popup --all');
        $this->info('Popup Module Permission Created ... ✅');
        Artisan::call('make:permission Project --all');
        $this->info('Project Module Permission Created ... ✅');
        Artisan::call('make:permission Service --all');
        $this->info('Service Module Permission Created ... ✅');
        Artisan::call('make:permission Team --all');
        $this->info('Team Module Permission Created ... ✅');
        Artisan::call('make:permission Testimonial --all');
        $this->info('Testimonial Module Permission Created ... ✅');
        Artisan::call('make:permission Ticket --all');
        $this->info('Ticket Module Permission Created ... ✅');
        Artisan::call('make:permission Payment --all');
        $this->info('Payment Module Permission Created ... ✅');
        Artisan::call('make:permission Post --all');
        $this->info('Post Module Permission Created ... ✅');
        Artisan::call('make:permission Application --all');
        $this->info('Application Module Permission Created ... ✅');
        Artisan::call('make:permission Career --all');
        $this->info('Career Module Permission Created ... ✅');
        Artisan::call('make:permission Attribute --all');
        $this->info('Attribute Module Permission Created ... ✅');
        Artisan::call('make:permission Product --all');
        $this->info('Product Module Permission Created ... ✅');
        Artisan::call('make:permission Process --all');
        $this->info('Process Module Permission Created ... ✅');
        Artisan::call('make:permission Software --all');
        $this->info('Software Module Permission Created ... ✅');
    }
}
