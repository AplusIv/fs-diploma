<?php

namespace App\Services;

use App\Models\Hall;
use App\Models\Place;
use Exception;

class PlaceService
{
  /**
   * Cоздание мест для конкретного зала
   * @param \App\Models\Hall $hall
   * @return array 
   */
  public function store(Hall $hall)
  {
    // создание мест для конкретного зала для добавления в БД
    $configuration = $hall->places * $hall->rows;
    $placesData = [];
    $r = 1;
    $p = 1;

    for ($i = 0; $i < $configuration; $i++) {
      $place = Place::create([
        'hall_id' => $hall->id,
        'row' => $r,
        'place' => $p,
        'type' => "standart",
        'is_selected' => false
      ]);

      array_push($placesData, $place);

      $p++;

      if ($p > $hall->places) {
        $r++;
        $p = 1;
      }
    }
    return $placesData;
  }

  /**
   * Обновление типа мест, если они были изменены по сравнению с текущими
   * @param array $placesData
   * @return array|string
   */
  public function updatePlacesByHallId(array $placesData, int $id)
  {
    try {
      $data = [];
      foreach ($placesData as $placeData) {
        $placeObj = (object) $placeData; // каст в объект, так как изначально placeData массив

        $place = Place::firstWhere([
          'hall_id' => $placeObj->hall_id, 
          'place' => $placeObj->place, 
          'row' => $placeObj->row
        ]); // найти в БД место с таким же расположением из запроса

        if ($place->type !== $placeObj->type) {
          $place->update(['type' => $placeObj->type]);
          array_push($data, $place); // добавление обновленных данных в массив для передачи в ответ на запрос
        }
      }
      return $data;
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  public function deletePlacesOfHall(Hall $hall)
  {
    try {
      $deletedPlacesCount = Place::where('hall_id', $hall->id)->delete(); // returns the number of the places deleted)
      return $deletedPlacesCount;
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }
}
