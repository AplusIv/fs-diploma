<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

final class OrderService
{
  public function __construct(private TicketService $ticketService) {}
  public function create()
  {
    $order = Order::create([
      'is_paid' => false, 
      'sum' => 100.00,
    ]);
    // $order->setAttribute('is_paid', false); // без валидации

    return $order;
  }

  public function store(array $ticketsData)
  {
    return DB::transaction(function() use ($ticketsData) {
      $order = $this->create();
      $this->ticketService->create($ticketsData, $order->id);
      // return response()->json("Order with id: $order->id stored", 200);

      // получение общей стоимости билетов
      $totalSum = $this->ticketService->getOrderSum($order->id);
      $order->sum = $totalSum;
      $order->save();

      return $order;
    }, 3);
    
    // $order = $this->create();
    // $this->ticketService->create($ticketsData, $order->id);
  }

  public function update(array $orderData, Order $order) 
  {
    DB::transaction(function() use ($orderData, $order) {
      // $order = Order::findOrFail($id);
      // $order->update(['sum' => '200.00']);
      $order->update($orderData);
      $this->ticketService->updateTicketsByOrder($order->id);
      // return response()->json("Order with id: $order->id updated", 200);
    }, 3);
  }
}
