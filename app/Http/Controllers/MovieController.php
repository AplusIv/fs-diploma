<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Http\Requests\MovieUpdateRequest;
use App\Models\Movie;
use Exception;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Movie::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieRequest $request)
    {
        try {
            $data  = $request->validated();
            $movie = Movie::create($data);

            if ($request->hasFile('poster')) {
                $path = $request->file('poster')->store('', 'posters');
                $url = Storage::url('posters/' . $path);
                $movie->poster = $url;
            } else{
                $movie->poster = "poster is not uploaded";
            }

            $movie->save();
            return response()->json($movie, 201);
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
            $movie = Movie::findOrFail($id);
            return $movie;
        } catch (Exception $e) {
            // dd($e->getMessage());
            return $e->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(MovieUpdateRequest $request, Movie $movie)
    {
        try {
            $data  = $request->validated();
            $movie->fill($data);

            if ($request->hasFile('poster')) {
                $path = $request->file('poster')->store('', 'posters');
                $url = Storage::url('posters/' . $path);
                $movie->poster = $url;
            } 

            $movie->save();
            return response()->json("Movie with id: $movie->id updated", 200);
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        if ($movie->delete()) {
            return response()->json(null, 204);
        }
        return null;
    }
}
