<?php

namespace App\Repositories;

use PDO;
use App\Models\Tickets\UserQrTicket;
use App\Models\Tickets\HistoryTicket;
use App\Models\Tickets\DancePasses;
use App\Models\Tickets\DanceTicket;


class TicketsRepository extends Repository
{
    public function getDanceTicketByID($danceTicketID): DanceTicket
    {
        error_log(print_r($danceTicketID, true), 3, __DIR__ . '/../file_with_erros_logs'); // Log the input data
        error_log(print_r("danceTicketID- method called", true), 3, __DIR__ . '/../file_with_erros_logs'); // Log the input data

        $stmt = $this->connection->prepare('SELECT * FROM DANCE_TICKET WHERE D_TicketID = :dance_ticket_id');
        $stmt->bindParam(':dance_ticket_id', $danceTicketID, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return new DanceTicket(
            $result['D_TicketID'],
            $result['DateAndTime'],
            $result['Location'],
            $result['Price'],
            $result['Singer'],
            $result['TotalQuantityOfAvailableTickets'],
            $result['SessionType'],
            $result['StartTime'],
            $result['EndTime']
        );
    }

    public function getHistoryTicketByID($historyTicketID): HistoryTicket
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

    public function getHistoryTicketPriceByType($historyTicketType): float
    {
        $stmt = $this->connection->prepare('SELECT Price FROM History_ticket_prices WHERE TicketType = :history_ticket_type');
        $stmt->bindParam(':history_ticket_type', $historyTicketType, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['Price'];
    }

    public function getPassByID($passID): DancePasses
    {
        $stmt = $this->connection->prepare('SELECT * FROM DANCE_PASSES WHERE PassesID = :pass_id');
        $stmt->bindParam(':pass_id', $passID, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return new DancePasses(
            $result['PassesID'],
            $result['Price'],
            $result['Date'],
            $result['AllDayPass']
        );
    }

    public function addQRTicketToDB($userId, $orderItem_FK, $date, $scanned)
    {
        $stmt = $this->connection->prepare('INSERT INTO USER_QR_TICKET (UserID, OrderItem_FK, Date, Scanned) VALUES (:user_id, :order_item_fk, :date, :scanned)');
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':order_item_fk', $orderItem_FK, PDO::PARAM_INT);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':scanned', $scanned, PDO::PARAM_BOOL);
        $stmt->execute();
    }
    public function getQRTickets($orderID): array
    {
        $stmt = $this->connection->prepare('SELECT UQT.TicketID, UQT.UserID, UQT.OrderItem_FK, UQT.Date, UQT.Scanned
                                            FROM USER_QR_TICKET UQT
                                            INNER JOIN ORDER_ITEM OI ON UQT.OrderItem_FK = OI.OrderItemID
                                            WHERE OI.Order_FK = :order_id;');
        $stmt->bindParam(':order_id', $orderID, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(function ($row) {
            return new UserQrTicket(
                $row['TicketID'],
                $row['UserID'],
                $row['OrderItem_FK'],
                $row['Date'],
                $row['Scanned']
            );
        }, $result);
    }


}