<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
        // return Hall::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tickets =Ticket::where('status', 'booked')->get();

        return view('orders.create', compact('tickets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        $order = Order::create($request->validated());
        $order->setAttribute('is_paid', false); // без валидации


        // До этого надо как-то создать билеты, а как их создать с пустым полем order-id??

        $tickets = Ticket::where('status', 'booked')->get();
        foreach ($tickets as $ticket) {
            $ticket->order_id = $order->id;
        }

        $sum = Ticket::where('status', 'booked')->place->sum('price');
        $order->sum = $sum;
        $order->save();

        return redirect()->route('places.index')->with('success','places created successfully.');    
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::find($id);
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $order = Order::find($id);
        return view('orders.edit', compact('order'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, Order $order)
    {
        $order->fill($request->validated());
        $order->save();
        return redirect()->route('orders.index')->with('success','order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        if ($order->delete()) {
            // return response(null, 404);
            // return response()->json(null, 204);
            return redirect()->route('orders.index')->with('success','order deleted successfully.');
        }
        return null; // если запись не найдена
    }
}
