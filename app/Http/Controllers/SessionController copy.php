<?php

namespace App\Http\Controllers;

// use App\Http\Requests\HallRequest;
use App\Http\Requests\SessionRequest;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Session;
// use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessions = Session::all();
        return view('sessions.index', compact('sessions'));
        // return Hall::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Hall $hall, Movie $movie
        // $option = CourseOption::where('course_code', $course_code)->firstOrFail();
        // return view('courses.test', ['option' => $option]);
        // $halls = Hall::all();
        // $movies = Movie::all();
        $hall = Hall::firstOrFail();
        $movie = Movie::firstOrFail();


        return view('sessions.create', compact('hall', 'movie'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SessionRequest $request)
    {
        // return Hall::created($request->validated()); // уточнить created
        Session::create($request->validated());
        return redirect()->route('sessions.index')->with('success','Session created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $session = Session::find($id);
        return view('sessions.show', compact('session'));
        // return Hall::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $session = Session::find($id);
        return view('sessions.edit', compact('session'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SessionRequest $request, Session $session)
    {
        $session->fill($request->validated());
        // return $hall->save(); // вернёт либо истину, либо ложь при попытке обновить значения

        $session->save();
        return redirect()->route('sessions.index')->with('success','session updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session)
    {
        // проверка возможности удаления
        if ($session->delete()) {
            // return response(null, 404);
            // return response()->json(null, 204);
            return redirect()->route('sessions.index')->with('success','session deleted successfully.');
        }
        return null; // если запись не найдена
    }
}
