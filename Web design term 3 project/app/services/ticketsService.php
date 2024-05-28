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

    public function scanQRCode($ticketID) {
        return $this->repository->scanQRCode($ticketID);
    }
    public function getQrCodeById($ticketID) {
        return $this->repository->getQrCodeById($ticketID);
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

    public function getAllDancePasses(): array
    {
        return $this->repository->getAllDancePasses();
    }

    public function getAllDanceTickets(): array
    {
        return $this->repository->getAllDanceTickets();
    }
    public function editDancePasses($id, $price, ?string $date, ?bool $allDayPass, ?int $maxPasses, ?int $maxAllDayPasses): void
    {
        $this->repository->editDancePasses($id, $price, $date, $allDayPass, $maxPasses, $maxAllDayPasses);
    }

    public function editDanceTickets($id, $date, $location, $price, $singer, $totalQuantityAvailable, $sessionType, $startTime, $endTime): void
    {
        $this->repository->editDanceTickets($id, $date, $location, $price, $singer, $totalQuantityAvailable, $sessionType, $startTime, $endTime);
    }
    public function deleteDancePasses($id): void
    {
        $this->repository->deleteDancePasses($id);
    }
    public function deleteDanceTickets($id): void
    {
        $this->repository->deleteDanceTickets($id);
    }
    public function addDancePasses($price, $date = null, $allDayPass = false, $maxPasses = null, $maxAllDayPasses = null): void
    {
        $this->repository->addDancePasses($price, $date, $allDayPass, $maxPasses, $maxAllDayPasses);
    }
    public function addDanceTicket($date, $location, $price, $singer, $totalQuantityAvailable, $sessionType, $startTime, $endTime): void
    {
        $this->repository->addDanceTicket($date, $location, $price, $singer, $totalQuantityAvailable, $sessionType, $startTime, $endTime);
    }

    public function addHistoryTicket($date, $language, $typeOfTicket, $tourID): int
    {
        return $this->repository->addHistoryTicket($date, $language, $typeOfTicket, $tourID);
    }


}