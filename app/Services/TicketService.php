<?php

namespace App\Services;

use App\Models\Ticket;
use Exception;

class TicketService
{
  public function create(array $ticketsData, int $id)
  {
    foreach ($ticketsData as $ticketData) {
      $ticket = Ticket::create($ticketData);
      // return $order;
      // $ticket->setAttribute('order_id', $id);

      // Назначение id заказа билетам
      $ticket->order_id = $id;
      $ticket->save();
      
      // $ticket->setAttribute('is_paid', false); // без валидации
    }
  }

  public function getTicketsByOrder(int $id)
  {
    try {
      $tickets = Ticket::where('order_id', $id)->get();
      // $places = Hall::findOrFail($id)->placesList;
      return $tickets;
    } catch (Exception $e) {
      // dd($e->getMessage());
      return $e->getMessage();
    }
  }

  public function store() {}

  public function updateTicketsByOrder(int $id) 
  {
    try {
      $tickets = $this->getTicketsByOrder($id);

      foreach ($tickets as $ticket) {
        // $ticket = Ticket::create($ticketData);
        // return $order;
        // $ticket->setAttribute('order_id', $id);

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
        // $currentPrice;
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
      
      return $totalSum;
    } catch (Exception $e) {
      return $e->getMessage();
    }    
  }
}
