<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ServeApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'serve:app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Serve to localhost and Stripe services';

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
        $this->info("Starting Sevices..");
        shell_exec("php artisan serve &
                   ./startStripe.sh");

        return 0;
    }
}
