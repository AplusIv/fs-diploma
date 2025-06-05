<?php

namespace App\Services;

use App\Models\Ticket;
use Exception;

class TicketService
{
  public function create(array $ticketsData, int $id)
  {
    try {
      foreach ($ticketsData as $ticketData) {
        $ticket = Ticket::create($ticketData);

        // Назначение id заказа билетам
        $ticket->order_id = $id;
        $ticket->save();
      }
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  public function getTicketsByOrder(int $id)
  {
    try {
      if (!$id) {
        throw new Exception("Order id is not a number", 404);
      }
      $tickets = Ticket::where('order_id', $id)->get();
      return $tickets;
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  public function store() {}

  public function updateTicketsByOrder(int $id)
  {
    try {
      $tickets = $this->getTicketsByOrder($id);

      foreach ($tickets as $ticket) {
        // Назначение id заказа билетам
        $ticket->status = 'paid';
        $ticket->save();
      }
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  public function getOrderSum(int $id): float|int|string
  {
    try {
      $tickets = $this->getTicketsByOrder($id);

      $totalSum = $tickets->reduce(function ($sum, $currentTicket): float|int {
        switch ($currentTicket->place->type) {
          case 'standart':
            $currentPrice = $currentTicket->place->hall->normal_price;
            break;
          case 'vip':
            $currentPrice = $currentTicket->place->hall->vip_price;
            break;
          default:
            break;
        }
        return $sum + $currentPrice;
      }, 0);

      return round($totalSum, 2);
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }
}
