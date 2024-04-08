<?php

namespace App\Services;

use App\Repositories\TicketsRepository;
use App\Models\Order_And_Invoice\OrderItem;
use App\Models\Tickets\HistoryTicket;
use App\Models\Tickets\DanceTicket;
use App\Models\Tickets\DancePasses;

class TicketsService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new TicketsRepository();
    }

    public function returnTypeOfTicket(OrderItem $ticketID): HistoryTicket|DanceTicket|DancePasses
    {
        if ($ticketID->historyTicket_FK != null) {
            return $this->repository->getHistoryTicketByID($ticketID->historyTicket_FK);
        } elseif ($ticketID->danceTicket_FK != null) {
            return $this->repository->getDanceTicketByID($ticketID->danceTicket_FK);
        }

        return $this->repository->getPassByID($ticketID->pass_FK);
    }

    public function getPassByID($passID)
    {
        return $this->repository->getPassByID($passID);
    }

    public function getHistoryTicketPriceByType($historyTicketType): float
    {
        return $this->repository->getHistoryTicketPriceByType($historyTicketType);
    }

    public function getDanceTicketByID($danceTicketID)
    {
        return $this->repository->getDanceTicketByID($danceTicketID);
    }

    public function getHistoryTicketByID($historyTicketID)
    {
        return $this->repository->getHistoryTicketByID($historyTicketID);
    }

    public function addQRTicketToDB($userId, $orderItem_FK, $date, $scanned)
    {
        $this->repository->addQRTicketToDB($userId, $orderItem_FK, $date, $scanned);
    }

    public function getQRTickets($orderID): array
    {
        return $this->repository->getQRTickets($orderID);
    }

    public function countHistoryTicketsReserved(int $tourID, string $language): int
    {
        return $this->repository->countHistoryTicketsReserved($tourID, $language);
    }
    public function getMaximumTicketsForHistoryReservation(string $language, int $tourID): int
    {
        return $this->repository->getMaximumTicketsForHistoryReservation($language, $tourID);
    }

    public function countDanceTicketsReserved(int $danceTicketID, int $OrderToIgnoreID): int
    {
        return $this->repository->countDanceTicketsReserved($danceTicketID, $OrderToIgnoreID);
    }
    public function countMaxPassesReserved(int $passID, int $OrderToIgnoreID): int
    {
        return $this->repository->countMaxPassesReserved($passID, $OrderToIgnoreID);
    }
}