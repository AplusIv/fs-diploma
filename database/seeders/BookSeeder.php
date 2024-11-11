<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::truncate();
        $faker = \Faker\Factory::create();
        for ($i=0; $i < 25; $i++) { 
            Book::create([
                'title' => $faker->sentence,
                'author' => $faker->name,
                'pages' => $faker->numberBetween(100, 1500)
            ]);
        }

    }
}
