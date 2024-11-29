<?php

namespace App\Http\Controllers;

use App\Http\Requests\HallRequest;
use App\Http\Requests\PriceRequest;
use App\Models\Hall;
use App\Models\Place;
use Illuminate\Http\Request;


class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $halls = Hall::all();
        // return view('halls.index', compact('halls'));
        return Hall::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('halls.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HallRequest $request)
    {
        // return Hall::created($request->validated()); // уточнить created
        Hall::create($request->validated());
        return redirect()->route('halls.index')->with('success','Hall created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hall = Hall::find($id);
        return view('halls.show', compact('hall'));
        // return Hall::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $hall = Hall::find($id);
        return view('halls.edit', compact('hall'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HallRequest $request, Hall $hall)
    {
        $hall->fill($request->validated());
        // return $hall->save(); // вернёт либо истину, либо ложь при попытке обновить значения

        $hall->save();
        return redirect()->route('halls.index')->with('success','Hall updated successfully.');
    }

    public function editPrice($id)
    {
        //
        $hall = Hall::find($id);
        return view('halls.editPrice', compact('hall'));
    }
    public function updatePriceForPlace(PriceRequest $request, $id)
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

        // $hall = Hall::find($id);
        // $validated = $request->validated();
        // // $validated = $request->safe()->only(['normal_price', 'vip_price']);
        // $newNormalPrice = $validated['normal_price'];
        // $newVipPrice = $validated['vip_price'];
        // $hall->normal_price = $newNormalPrice;
        // $hall->vip_price = $newVipPrice;
        // $hall->save();
        return redirect()->route('halls.index')->with('success','prices for hall updated successfully.');

        // $place->fill($request->validated());
        // // return $hall->save(); // вернёт либо истину, либо ложь при попытке обновить значения

        // $place->save();
        // return redirect()->route('places.index')->with('success','place updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hall $hall)
    {
        // проверка возможности удаления
        if ($hall->delete()) {
            // return response(null, 404);
            // return response()->json(null, 204);
            return redirect()->route('halls.index')->with('success','Hall deleted successfully.');
        }
        return null; // если запись не найдена
    }
}
