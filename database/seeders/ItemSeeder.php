<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            Item::updateOrCreate(
                [
                    'name' => 'Item ' . $i,
                    'category_id' => ($i % 3 == 0) ? 1 : 3,
                ],
                [
                    'description' => 'Item ' . $i . ' desc',
                    'qty' => $i * 5,
                    'price' => $i * 5.5,
                    'status' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}
