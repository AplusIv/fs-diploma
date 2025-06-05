<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Place;
// use App\Models\Session;
use App\Models\Ticket;
use Exception;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return Ticket::all();
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request)
    {
        try {
            $placeId = $request->place_id;
            // $sessionId = $request->session_id;

            $place = Place::findOrFail($placeId);
            // $session = Session::findOrFail($sessionId); // добавить проверку даты

            if ($place->type !== 'disabled') {
                $ticket = Ticket::create($request->validated());

                // поменять тип места, чтобы было не выбрать повторно
                // $place->type = 'disabled';
                // $place->save();

                return response()->json($ticket, 201);
            } else {
                throw new Exception("Cannot add ticket to this place", 1);
            }
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
            $ticket = Ticket::findOrFail($id);
            return $ticket;
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {}

    public function getTicketsByOrderId($id)
    {
        try {
            if (!$id) {
                throw new Exception("Order id is not a true value", 404);
            }
            $tickets = Ticket::where('order_id', $id)->get();
            return $tickets;
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketRequest $request, Ticket $ticket)
    {
        try {
            $ticket->fill($request->validated());

            // вернёт либо истину, либо ложь при попытке обновить значения
            $ticket->save();
            return response()->json("Ticket with id: $ticket->id updated", 200);
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        try {
            if ($ticket->delete()) {
                return response()->json(null, 204);
            }
            return null; // если запись не найдена
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }
}
