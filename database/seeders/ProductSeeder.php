<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            ['code' => 'P001', 'description' => 'Produto 1', 'price' => 10.00],
            ['code' => 'P002', 'description' => 'Produto 2', 'price' => 20.00],
            ['code' => 'P003', 'description' => 'Produto 3', 'price' => 30.00],
        ]);
    }
}
