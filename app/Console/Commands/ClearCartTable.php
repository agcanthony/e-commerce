<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearCartTable extends Command
{
    protected $signature = 'cart:clear';
    protected $description = 'Clear the cart table';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        DB::table('cart')->delete();
        $this->info('Cart table cleared successfully.');
    }
}
