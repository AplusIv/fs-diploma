<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceRequest;
use App\Http\Requests\TypeRequest;
use App\Models\Hall;
use App\Models\Place;
use App\Models\Session;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $places = Place::all();
        return view('places.index', compact('places'));
        // return Hall::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hall = Hall::firstOrFail();
        $session = Session::firstOrFail();

        return view('places.create', compact('hall', 'session'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlaceRequest $request)
    {
        // return Hall::created($request->validated()); // уточнить created
        Place::create($request->validated());
        return redirect()->route('places.index')->with('success','places created successfully.');    
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $place = Place::find($id);
        return view('places.show', compact('place'));
        // return Hall::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $place = Place::find($id);
        return view('places.edit', compact('place'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlaceRequest $request, Place $place)
    {
        $place->fill($request->validated());
        // return $hall->save(); // вернёт либо истину, либо ложь при попытке обновить значения

        $place->save();
        return redirect()->route('places.index')->with('success','place updated successfully.');

    }

    public function editType($id)
    {
        $place = Place::find($id);
        return view('places.editType', compact('place'));
    }
    public function updateActiveTypeForPlace(TypeRequest $request, $id)
    {
        // $validated = $request->safe()->only(['normal_price', 'vip_price']);
        // $hall->fill($validated);
        // $hall->fill($request->validated());
        // $validated = $request->only(['normal_price', 'vip_price']);
        // $newPrice = $validated->normal_price;
        // $hall = Hall::find($id);
        // $hall->normal_price = $request->normal_price;
        // $hall->vip_price = $request->vip_price;
        // $hall->update($request->all());
        // $hall->save();


        $place = Place::find($id);
        $place->fill($request->validated());
        $place->save(); // вернёт либо истину, либо ложь при попытке обновить значения


        // $place = Place::find($id);
        // $place->fill($request->validated());
        // $place->save(); // вернёт либо истину, либо ложь при попытке обновить значения


        // $hall = Hall::find($id);
        // $validated = $request->validated();
        // // $validated = $request->safe()->only(['normal_price', 'vip_price']);
        // $newNormalPrice = $validated['normal_price'];
        // $newVipPrice = $validated['vip_price'];
        // $hall->normal_price = $newNormalPrice;
        // $hall->vip_price = $newVipPrice;
        // $hall->save();
        return redirect()->route('places.index')->with('success','type of place updated successfully.');

        // $place->fill($request->validated());
        // // return $hall->save(); // вернёт либо истину, либо ложь при попытке обновить значения

        // $place->save();
        // return redirect()->route('places.index')->with('success','place updated successfully.');
    }

    // public function updatePriceForPlace(PlaceRequest $request, Place $place)
    // {
    //     $validated = $request->safe()->only(['price']);
    //     $place->fill($validated);
    //     $place->save();
    //     return redirect()->route('places.index')->with('success','place updated successfully.');

    //     // $place->fill($request->validated());
    //     // // return $hall->save(); // вернёт либо истину, либо ложь при попытке обновить значения

    //     // $place->save();
    //     // return redirect()->route('places.index')->with('success','place updated successfully.');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        // Нужен ли этот метод?
        // проверка возможности удаления
        if ($place->delete()) {
            // return response(null, 404);
            // return response()->json(null, 204);
            return redirect()->route('places.index')->with('success','place deleted successfully.');
        }
        return null; // если запись не найдена
    }
}
