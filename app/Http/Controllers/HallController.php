<?php

namespace App\Http\Controllers;

use App\Http\Requests\HallRequest;
use App\Http\Requests\PlacesArrayRequest;
use App\Http\Requests\PriceRequest;
use App\Models\Hall;
use App\Models\Place;
use App\Services\PlaceService;
use Exception;


class HallController extends Controller
{
    // PlaceService добавляется в контейнер контроллера, либо передаётся в виде переменной в конкретный метод
    public function __construct(private PlaceService $placeService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return Hall::all();
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(HallRequest $request)
    {
        try {
            $hall = Hall::create($request->validated());
            $placesData = $this->placeService->store($hall);
            return response()->json(['new hall' => $hall, 'new places' => $placesData], 201);
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    public function storePlaces(Hall $hall)
    {
        try {
            $placesData = $this->placeService->store($hall);
            return response()->json(['new places' => $placesData], 201);
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $hall = Hall::findOrFail($id);
            return $hall;
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function getPlacesByHall($id)
    {
        try {
            $places = Hall::findOrFail($id)->placesList;
            return $places;
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    public function edit($id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(HallRequest $request, Hall $hall)
    {
        try {
            $hall->fill($request->validated());
            $hall->save();
            return response()->json("Hall with id: $hall->id updated", 200);
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }
    /**
     * Обновление типа мест в конкретном зале
     */
    public function updateHallPlaces(PlacesArrayRequest $request, int $id)
    {
        try {
            $responseData = $this->placeService->updatePlacesByHallId($request->validated(), $id);
            return response()->json(['updated places' => $responseData], 200);
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    public function deletePlaces(Hall $hall)
    {
        try {
            $count = $this->placeService->deletePlacesOfHall($hall);
            return response()->json(['deleted places count' => $count], 204);
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hall $hall)
    {
        try {
            if ($hall->delete()) {
                return response()->json(null, 204);
            }
            return null; // если запись не найдена
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }


    // следующие 2 метода не испльзуются
    public function editPrice($id)
    {
        // метод не используется
        $hall = Hall::find($id);
        return view('halls.editPrice', compact('hall'));
    }
    public function updatePriceForPlace(PriceRequest $request, $id)
    {
        // метод не используется
        $hall = Hall::find($id);
        $hall->fill($request->validated());
        $hall->save(); // вернёт либо истину, либо ложь при попытке обновить значения

        // изменение цен в place
        $places = Place::where('hall_id', $id)->get(); //
        foreach ($places as $place) {
            if ($place->type === 'vip') {
                $place->price = $place->hall->vip_price;
            } elseif ($place->type === 'normal') {
                $place->price = $place->hall->normal_price;
            } else null;
            $place->save();
        }
        return redirect()->route('halls.index')->with('success', 'prices for hall updated successfully.');
    }
}
