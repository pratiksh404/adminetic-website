<?php

namespace Adminetic\Website\Console\Commands;

use Illuminate\Console\Command;

class AdmineticWebsiteRollbackCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:rollback:adminetic-website  {--f|force : Force the operation to run when in production.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to rollback adminetic website module tables.';

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
        if (config('website.publish_migrations', true)) {
            $path = config('website.migration_publish_path', 'database/migrations/website');

            if (file_exists($path)) {
                $this->call('migrate:reset', [
                    '--path' => $path,
                    '--force' => $this->option('force'),
                ]);
            } else {
                $this->warn('No migrations found! Consider publish them first: <fg=green>php artisan vendor:publish --tag=website-migrations</>');
            }
        } else {
            $this->info('Please turn on publish_migrations option in config/website');
        }
    }
}
