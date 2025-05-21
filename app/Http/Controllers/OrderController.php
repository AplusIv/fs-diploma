<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Requests\TicketRequest;
use App\Models\Order;
use App\Services\OrderService;
use Exception;

class OrderController extends Controller
{
    // OrderService добавляется в контейнер контроллера, либо передаётся в виде переменной в конкретный метод
    public function __construct(private OrderService $orderService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return $orders;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request )
    {
        $responseData = $this->orderService->store($request->validated());
        return response()->json(['newOrder' => $responseData], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $order = Order::findOrFail($id);
            return $order;
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, Order $order)
    {
        $this->orderService->update($request->validated(), $order);
        return response()->json("Order with id: $order->id updated", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        if ($order->delete()) {
            return response()->json(null, 204);
        }
        return null; // если запись не найдена
    }
}
