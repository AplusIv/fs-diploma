<?php

namespace App\Services;

use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\DB;

final class OrderService
{
  public function __construct(private TicketService $ticketService) {}
  public function create()
  {
    try {
      $order = Order::create([
        'is_paid' => false,
        'sum' => 0.00,
      ]);
      // $order->setAttribute('is_paid', false); // без валидации

      return $order;
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  public function store(array $ticketsData)
  {
    try {
      return DB::transaction(function () use ($ticketsData) {
        $order = $this->create();
        $this->ticketService->create($ticketsData, $order->id);

        // получение общей стоимости билетов
        $totalSum = $this->ticketService->getOrderSum($order->id);
        $order->sum = $totalSum;
        $order->save();

        return $order;
      }, 3);
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  public function update(array $orderData, Order $order)
  {
    try {
      DB::transaction(function () use ($orderData, $order) {
        $order->update($orderData);
        $this->ticketService->updateTicketsByOrder($order->id);
      }, 3);
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }
}
