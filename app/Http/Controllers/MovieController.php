<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Models\Movie;
use Exception;
use PhpParser\Node\Stmt\TryCatch;

// use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::all();
        // return view('movies.index', compact('movies'));
        return Movie::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieRequest $request)
    {
        // return Hall::created($request->validated()); // уточнить created
        $movie = Movie::create($request->validated());
        // return redirect()->route('movies.index')->with('success','movie created successfully.');
        return response()->json($movie, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $movie = Movie::find($id);
        // return view('movies.show', compact('movie'));
        // return Hall::findOrFail($id);
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
    public function edit($id)
    {
        // $movie = Movie::find($id);
        // return view('movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovieRequest $request, Movie $movie)
    {
        // try {
        //     $movie->fill($request->validated());
        //     $movie->save();
        //     return response()->json("Movie with id: $movie->id updated", 200);    
        // } catch (Exception $e) {
        //     return $e->getMessage();
        // }
        $movie->fill($request->validated());
        // return $hall->save(); // вернёт либо истину, либо ложь при попытке обновить значения

        $movie->save();
        return response()->json("Movie with id: $movie->id updated", 200);

        // return redirect()->route('movies.index')->with('success','movie updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        // проверка возможности удаления
        if ($movie->delete()) {
            return response()->json(null, 204);

            // return response(null, 404);
            // return response()->json(null, 204);
            // return redirect()->route('movies.index')->with('success','movie deleted successfully.');
        }
        // $e = new Exception('ошибка удаления', 404);
        // return $e; // если запись не найдена
        return null;
    }
}
