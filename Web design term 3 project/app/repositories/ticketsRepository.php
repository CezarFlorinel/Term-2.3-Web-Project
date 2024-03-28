<?php

namespace App\Repositories;

use PDO;
use App\Models\Tickets\UserQrTicket;
use App\Models\Tickets\HistoryTicket;
use App\Models\Tickets\DancePasses;
use App\Models\Tickets\DanceTicket;


class TicketsRepository extends Repository
{
    public function getDanceTicketByID($danceTicketID)
    {
        $stmt = $this->connection->prepare('SELECT * FROM DANCE_TICKET WHERE D_TicketID = :dance_ticket_id');
        $stmt->bindParam(':dance_ticket_id', $danceTicketID, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return new DanceTicket(
            $result['D_TicketID'],
            $result['Date'],
            $result['Location'],
            $result['Price'],
            $result['Singer'],
            $result['TotalQuantityOfAvailableTickets'],
            $result['SessionType'],
            $result['StartTime'],
            $result['EndTime']
        );
    }

    public function getHistoryTicketByID($historyTicketID)
    {
        $stmt = $this->connection->prepare('SELECT * FROM HISTORY_TICKET WHERE H_TicketID = :history_ticket_id');
        $stmt->bindParam(':history_ticket_id', $historyTicketID, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return new HistoryTicket(
            $result['H_TicketID'],
            $result['DateAndTime'],
            $result['Language'],
            $result['TypeOfTicket'],
            $result['RouteID']
        );
    }

}