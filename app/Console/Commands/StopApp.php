<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StopApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stop:app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stop serving to localhost and Stripe services';

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
        shell_exec("pkill stripe >> /dev/null");
        shell_exec("pkill php");
        $this->info("Services killed");
    }
}
