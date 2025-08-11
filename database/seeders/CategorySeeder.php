<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Category::updateOrCreate(
                [
                    'name' => 'Category ' . $i,
                ],
                [
                    'description' => 'Category ' . $i . ' desc',
                ]
            );
        }
    }
}
