<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'Name' => 'Pertamax',
                'Description' => 'Bahan bakar berkualitas tinggi dengan oktan 92, cocok untuk kendaraan modern yang membutuhkan performa optimal dan efisiensi bahan bakar.',
                'Price' => 12200,
                'Stock' => 1000,
                'image' => 'pertamax.jpg',
            ],
            [
                'Name' => 'Pertalite',
                'Description' => 'Bahan bakar ekonomis dengan oktan 90, dirancang untuk kendaraan dengan kompresi rendah namun tetap memberikan pembakaran yang bersih.',
                'Price' => 10000,
                'Stock' => 1500,
                'image' => 'pertalite.jpg',
            ],
            [
                'Name' => 'Pertamax Turbo',
                'Description' => 'Bahan bakar premium dengan oktan 98, diformulasikan khusus untuk kendaraan berperforma tinggi dan mesin turbocharged.',
                'Price' => 13800,
                'Stock' => 800,
                'image' => 'pertamax_turbo.jpg',
            ],
            [
                'Name' => 'Solar',
                'Description' => 'Bahan bakar diesel berkualitas untuk kendaraan niaga dan mesin industri, memberikan tenaga maksimal dengan emisi rendah.',
                'Price' => 6800,
                'Stock' => 2000,
                'image' => 'solar.jpg',
            ],
            [
                'Name' => 'Pertamax Plus',
                'Description' => 'Bahan bakar dengan teknologi canggih untuk kendaraan mewah, memberikan akselerasi halus dan perlindungan mesin optimal.',
                'Price' => 14500,
                'Stock' => 600,
                'image' => 'pertamax_plus.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['Name' => $product['Name']],
                $product
            );
        }

        $this->command->info('Products seeded successfully!');
    }
}