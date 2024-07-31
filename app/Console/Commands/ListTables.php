<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class ListTables extends Command
{
    protected $signature = 'db:list-tables';
    protected $description = 'List all tables in the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
        $this->info('Tables in the database:');
        foreach ($tables as $table) {
            $this->line($table);
        }
    }
}