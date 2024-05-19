<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Place;
use App\Models\Session;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::all();
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $place = Place::firstOrFail();
        $session = Session::firstOrFail();

        return view('tickets.create', compact('place', 'session'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request)
    {
        // условия: место свободно и не заблокировано
        // сеанс ещё существует, дата не прошла
        // $newTicket = Ticket::create($request->validated());
        $placeId = $request->place_id;
        $sessionId = $request->session_id;

        $place = Place::findOrFail($placeId);
        $session = Session::findOrFail($sessionId);

        if ($place->type != 'not allowed' && $place->is_free) {
        // if ($place->is_free) {

            Ticket::create($request->validated());

            $place->is_free = false;
            $place->is_selected = true;

            
            $place->save();
            return redirect()->route('tickets.index')->with('success','tickets created successfully.');    
        } else {
            // если не прошли проверку
            return back()->withInput();
        }
        

        // $newTicket = Ticket::create($request->validated());
        // $placeId = $request->place_id;

        // $place = Place::findOrFail($placeId);
        // $place->is_free = false;
        // $place->save();
        // $newTicket->place->is_free = false;
        // $newTicket->save();

        // return redirect()->route('tickets.index')->with('success','tickets created successfully.');    
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);
        return view('tickets.show', compact('ticket'));
        // return Hall::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ticket = Ticket::find($id);
        return view('tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketRequest $request, Ticket $ticket)
    {
        $ticket->fill($request->validated());
        // return $hall->save(); // вернёт либо истину, либо ложь при попытке обновить значения

        $ticket->save();
        return redirect()->route('tickets.index')->with('success','ticket updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        if ($ticket->delete()) {
            // return response(null, 404);
            // return response()->json(null, 204);
            return redirect()->route('tickets.index')->with('success','ticket deleted successfully.');
        }
        return null; // если запись не найдена
    }
}
