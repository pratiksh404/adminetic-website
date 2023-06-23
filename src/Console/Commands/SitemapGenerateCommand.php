<?php

namespace Adminetic\Website\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;

class SitemapGenerateCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        SitemapGenerator::create(config('app.url'))
            ->writeToFile(public_path('sitemap.xml'));
        $this->info('Sitemap Generated');
    }
}
