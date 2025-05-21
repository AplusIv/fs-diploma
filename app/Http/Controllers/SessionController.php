<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionRequest;
use App\Models\Session;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Session::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(SessionRequest $request)
    {
        $session = Session::create($request->validated());
        return response()->json($session, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $session = Session::findOrFail($id);
            return $session;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {}

    public function getSessionsByDate(Request $request)
    {
        try {
            $today = date('Y-m-d');
            $validator = Validator::make($request->route()->parameters(), [
                'date' => ['required', 'date_format:Y-m-d', "after_or_equal:{$today}"],
            ]);

            // Если проверка не прошла...
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            // Получить проверенные данные...
            $validated = $validator->validated();

            $sessions = Session::where('date', $validated)->get();
            return $sessions;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SessionRequest $request, Session $session)
    {
        $session->fill($request->validated());
        $session->save();
        return response()->json("Session with id: $session->id updated", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session)
    {
        if ($session->delete()) {
            return response()->json(null, 204);
        }
        return null; // если запись не найдена
    }
}
