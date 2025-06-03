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

    /**
     * Display list of sessions with given date.
     */
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
     * Toggle "is_sales_active" field for all specified resource.
     */
    public function toggleActiveSales(Session $session)
    {
        try {
            // новые сеансы создаются с is_sales_active === false, поэтому могут быть разные статусы сеансов
            $inactiveSessions = Session::all()->where('is_sales_active', operator: false);
            $activeSessions = Session::all()->where('is_sales_active', operator: true);

            // if ($activeSessions->isEmpty()) {
            // Если большинство сеансов с неактивным статусом покупки -> активировать
            if (count($inactiveSessions) > count($activeSessions)) {
                $inactiveSessions->toQuery()->update(['is_sales_active' => true]);
                return response()->json("Sessions are active now", 200);
            } else {
                $activeSessions->toQuery()->update(['is_sales_active' => false]);
                return response()->json("Sessions are inactive now", 200);
            }
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
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
