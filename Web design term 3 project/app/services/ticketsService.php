<?php

namespace App\Services;

use App\Repositories\TicketsRepository;
use App\Models\Order_And_Invoice\OrderItem;

class TicketsService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new TicketsRepository();
    }

    public function returnTypeOfTicket(OrderItem $ticketID)
    {
        if ($ticketID->dancePassFK != null) {
            return $this->repository->getHistoryTicketByID($ticketID->historyTicketFK);
        } elseif ($ticketID->danceTicketFK != null) {
            return $this->repository->getDanceTicketByID($ticketID->danceTicketFK);
        } elseif ($ticketID->historyTicketFK != null) {
            //return $this->repository->getDancePassByID($ticketID->dancePassFK);
        }

    }

    public function getDanceTicketByID($danceTicketID)
    {
        return $this->repository->getDanceTicketByID($danceTicketID);
    }

    public function getHistoryTicketByID($historyTicketID)
    {
        return $this->repository->getHistoryTicketByID($historyTicketID);
    }
}