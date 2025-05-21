<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceRequest;
use App\Http\Requests\TypeRequest;
use App\Models\Hall;
use App\Models\Place;
use App\Models\Session;
use App\Services\PlaceService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PlaceController extends Controller
{
    // PlaceService добавляется в контейнер контроллера, либо передаётся в виде переменной в конкретный метод
    public function __construct(private PlaceService $placeService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Place::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlaceRequest $request)
    {
        $place = Place::create($request->validated());
        return response()->json($place, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $place = Place::findOrFail($id);
            return $place;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlaceRequest $request, Place $place)
    {
        $place->fill($request->validated());
        $place->save();
        return response()->json("Place with id: $place->id updated", 200);
    }

    public function editType($id)
    {
        $place = Place::find($id);
        return view('places.editType', compact('place'));
    }
    public function updateActiveTypeForPlace(TypeRequest $request, $id)
    {
        // метод не используется
        $place = Place::find($id);
        $place->fill($request->validated());
        $place->save(); // вернёт либо истину, либо ложь при попытке обновить значения
        return redirect()->route('places.index')->with('success','type of place updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        if ($place->delete()) {
            return response()->json(null, 204);
        }
        return null; // если запись не найдена
    }
}
