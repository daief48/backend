<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Wireless Mouse',
                'description' => 'Ergonomic wireless mouse',
                'price' => 850,
                'image' => 'products/mouse.jpg',
                'category_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bluetooth Headphones',
                'description' => 'Noise cancelling headphones',
                'price' => 3200,
                'image' => 'products/headphone.jpg',
                'category_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Men T-Shirt',
                'description' => 'Cotton casual t-shirt',
                'price' => 650,
                'image' => 'products/tshirt.jpg',
                'category_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Rice Cooker',
                'description' => 'Automatic electric rice cooker',
                'price' => 4200,
                'image' => 'products/rice-cooker.jpg',
                'category_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
