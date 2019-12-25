<?php

namespace App\Console\Commands;

use App\Backend;
use Illuminate\Console\Command;

class BDTopuoResponse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:bd-topup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $backend = new Backend();
        $response = $backend->connect('/api/check-bd-topup-status',false);
    }
}
