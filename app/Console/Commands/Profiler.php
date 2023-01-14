<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Profiler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start:profiler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Executes profiling capabilities';

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
        $this->line("Starting profiler server..");
        exec("php artisan profiler:server >> /dev/null &");
        $this->line("Starting profiler client..");
        exec("php artisan profiler:client");
        exec("php artisan profiler:status");
        
        return 0;
    }
}
