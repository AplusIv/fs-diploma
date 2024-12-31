<?php

namespace Database\Seeders;

use App\Models\Hall;
use App\Models\Movie;
use App\Models\Place;
use App\Models\Session;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hall::truncate(); // удалить предыдущие записи перед созданием новых
        // Movie::truncate(); // удалить предыдущие записи перед созданием новых
        // Session::truncate(); // удалить предыдущие записи перед созданием новых

        $hall = Hall::factory()->create();
        $movie = Movie::factory()->create();
        Session::factory()->count(4)->for($hall)->for($movie)->create();

        $configuration = $hall->places * $hall->rows;
        $r = 1;
        $p = 1;
        for ($i = 0; $i < $configuration; $i++) {
            Place::factory()
                ->for($hall)
                ->state([
                    'row' => $r,
                    'place' => $p
                ])->create();

            $p++;

            if ($p > $hall->places) {
                $r++;
                $p = 1;
            }
        }

    }
}
