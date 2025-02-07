<?php

namespace App\Http\Controllers;

// use App\Http\Requests\HallRequest;
use App\Http\Requests\SessionRequest;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Session;
use Exception;

// use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessions = Session::all();
        // return view('sessions.index', compact('sessions'));
        return Session::all();
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
        // $hall = Hall::firstOrFail();
        // $movie = Movie::firstOrFail();


        // return view('sessions.create', compact('hall', 'movie'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SessionRequest $request)
    {
        // return Hall::created($request->validated()); // уточнить created
        $session = Session::create($request->validated());
        // return redirect()->route('sessions.index')->with('success','Session created successfully.');
        return response()->json($session, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $session = Session::find($id);
        // return view('sessions.show', compact('session'));
        // return Hall::findOrFail($id);
        try {
            $session = Session::findOrFail($id);
            return $session;
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
        // $session = Session::find($id);
        // return view('sessions.edit', compact('session'));
    }

    public function getSessionsByDate($date)
    {
        // $hall = Hall::find($id);
        // return view('halls.show', compact('hall'));
        // return Hall::findOrFail($id);
        try {
            $sessions = Session::where('date', $date)->get();
            // $places = Hall::findOrFail($id)->placesList;
            return $sessions;
        } catch (Exception $e) {
            // dd($e->getMessage());
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SessionRequest $request, Session $session)
    {
        $session->fill($request->validated());
        // return $hall->save(); // вернёт либо истину, либо ложь при попытке обновить значения

        $session->save();
        return response()->json("Session with id: $session->id updated", 200);

        // return redirect()->route('sessions.index')->with('success','session updated successfully.');

        // try {
        //     // $session = Session::findOrFail($id);
        //     // return $session;
        //     $session->fill($request->validated());
        //     // return $hall->save(); // вернёт либо истину, либо ложь при попытке обновить значения

        //     $session->save(); // вернёт либо истину, либо ложь при попытке обновить значения
        //     // return response()->json("Session with id: $session->id updated", 200);    
        // } catch (Exception $e) {
        //     // dd($e->getMessage());
        //     return $e->getMessage();
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session)
    {
        // проверка возможности удаления
        if ($session->delete()) {
            return response()->json(null, 204);
            // return response(null, 404);
            // return response()->json(null, 204);
            // return redirect()->route('sessions.index')->with('success','session deleted successfully.');
        }
        return null; // если запись не найдена
    }
}
