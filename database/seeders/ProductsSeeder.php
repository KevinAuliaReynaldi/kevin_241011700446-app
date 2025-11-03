<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Products')->insert([
            [
                'name'=> 'Pertamax',
                'description'=> 'Anti Oplosan',
                'price'=> '12200',
                'stock'=> '1000',
                "created_at"=> now(),
                'updated_at'=> now(),
            ],
            [
                'name'=> 'Pertalite',
                'description'=> 'Anti Oplosan',
                'price'=> '10000',
                'stock'=> '1000',
                "created_at"=> now(),
                'updated_at'=> now(),
            ],
            [
                'name'=> 'Pertamax Turbo',
                'description'=> 'Anti Oplosan',
                'price'=> '13800',
                'stock'=> '1000',
                "created_at"=> now(),
                'updated_at'=> now(),
            ],
        ]);
    }
}
