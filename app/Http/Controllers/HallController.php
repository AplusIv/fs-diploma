<?php

namespace App\Http\Controllers;

use App\Http\Requests\HallRequest;
use App\Models\Hall;
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
        return view('halls.index', compact('halls'));
        // return Hall::all();
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
