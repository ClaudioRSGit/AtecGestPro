<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RefreshApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleans cache, configs, routes, views and updates composer autoload';

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
        $this->call('cache:clear');
        $this->info('Cache cleared!');

        $this->call('config:clear');
        $this->info('Configuration cache cleared!');

        $this->call('route:clear');
        $this->info('Route cache cleared!');

        $this->call('view:clear');
        $this->info('View cache cleared!');

        exec('composer dump-autoload');
        $this->info('Composer autoload dumped!');
    }
}
