<?php

namespace Database\Seeders;

use App\Models\Hall;
use App\Models\Movie;
use App\Models\Place;
use App\Models\Session;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hall::truncate(); // удалить предыдущие записи перед созданием новых
        Movie::truncate(); // удалить предыдущие записи перед созданием новых
        Place::truncate(); // удалить предыдущие записи перед созданием новых
        Session::truncate(); // удалить предыдущие записи перед созданием новых

        /* 
        Создать изначально: 
         - 3 зала, 
         - 4 фильма,
         - 3 конфигурации мест, из которых заполнить модель мест
         - 2 сеанса, на каждый фильм в день (на 2 недели начиная с сегодняшнего дня). Залы выбрать вручную.         
        */

        // 1) 
        $hall1 = Hall::factory()->create();
        $hall2 = Hall::factory()->create();
        $hall3 = Hall::factory()->create();


        // 2)
        $movie1 = Movie::factory()->create();
        $movie2 = Movie::factory()->create();
        $movie3 = Movie::factory()->create();
        $movie4 = Movie::factory()->create();
        $movies = [$movie1, $movie2, $movie3, $movie4];

        // директория с постерами к фильмам
        $files = Storage::disk('posters')->files();

        // обновить рандомные (могут повторяться) постеры, заданные в фабрике, индивидуальными
        for ($i = 0; $i < count($movies); $i++) {
            $movies[$i]->update([
                'poster' => Storage::url('posters/' . $files[$i]),
            ]);
        }

        // 3)
        $halls = [$hall1, $hall2, $hall3];
        foreach ($halls as $hall) {
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

        // 4) 
        $today = date('Y:i');
        $days = 14;
        for ($i = 0; $i < $days; $i++) {
            Session::factory()
                ->count(2)
                ->state(new Sequence(
                    [
                        'date' => date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") + $i, date("Y"))),
                        'time' => '10:15',
                    ],
                    [
                        'date' => date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") + $i, date("Y"))),
                        'time' => '18:45',
                    ]
                ))
                ->for($hall1)
                ->for($movie2)
                ->create();

            // 
            Session::factory()
                ->count(2)
                ->state(new Sequence(
                    [
                        'date' => date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") + $i, date("Y"))),
                        'time' => '10:00',
                    ],
                    [
                        'date' => date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") + $i, date("Y"))),
                        'time' => '21:30',
                    ]
                ))
                ->for($hall2)
                ->for($movie3)
                ->create();

            // 
            Session::factory()
                ->count(2)
                ->state(new Sequence(
                    [
                        'date' => date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") + $i, date("Y"))),
                        'time' => '15:30',
                    ],
                    [
                        'date' => date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") + $i, date("Y"))),
                        'time' => '17:40',
                    ]
                ))
                ->for($hall3)
                ->for($movie4)
                ->create();

            // 
            Session::factory()
                ->count(2)
                ->state(new Sequence(
                    [
                        'date' => date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") + $i, date("Y"))),
                        'time' => '14:00',
                    ],
                    [
                        'date' => date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") + $i, date("Y"))),
                        'time' => '21:45',
                    ]
                ))
                ->for($hall1)
                ->for($movie1)
                ->create();
        }
    }
}
