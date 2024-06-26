<?php

namespace App\Repositories;

use PDO;
use App\Models\Tickets\UserQrTicket;
use App\Models\Tickets\HistoryTicket;
use App\Models\Tickets\DancePasses;
use App\Models\Tickets\DanceTicket;
use PDOException;


class TicketsRepository extends Repository
{
    public function getDanceTicketByID($danceTicketID): DanceTicket
    {
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
            $result['RouteID'],
            $result['TourID']

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
            $result['AllDayPass'],
            $result['MaxPasses'],
            $result['MaxAllDayPasses']
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

    public function scanQRCode(string $ticketID)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE [USER_QR_TICKET] SET Scanned = 1 WHERE TicketID = :ticketID");
            $stmt->bindValue(':ticketID', $ticketID);
            return $stmt->execute();
        } catch (\PDOException $e) {
            throw new \exception('Error scanning qr code: ' . $e->getMessage());
        }
    }
    public function getQrCodeById($ticketID): ?UserQrTicket
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM USER_QR_TICKET WHERE TicketID = :TicketID");
            $stmt->bindParam(':TicketID', $ticketID, PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return new UserQrTicket(
                    $result['TicketID'],
                    $result['UserID'],
                    $result['OrderItem_FK'],
                    $result['Date'],
                    $result['Scanned']
                );
            } else {
                return null;
            }
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function countHistoryTicketsReserved(int $tourID, string $lanuguage): int
    {
        $stringTypeOfTicket = 'Family Ticket';
        $stmt = $this->connection->prepare('SELECT 
            SUM(CASE 
                WHEN TypeOfTicket = :type_of_ticket THEN 4 
                ELSE 1 
                END) AS TotalTickets
                FROM HISTORY_TICKET
                WHERE 
                [Language] = :language AND 
                TourID = :tour_id;');
        $stmt->bindParam(':tour_id', $tourID, PDO::PARAM_INT);
        $stmt->bindParam(':language', $lanuguage, PDO::PARAM_STR);
        $stmt->bindParam(':type_of_ticket', $stringTypeOfTicket, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) $result['TotalTickets'];
    }

    public function getMaximumTicketsForHistoryReservation(string $language, int $tourID): int
    {
        if ($language == "English") {

            $stmt = $this->connection->prepare('SELECT maxTicketsEnglish FROM HISTORY_TOURS WHERE InformationID = :info_id;');
            $stmt->bindParam(':info_id', $tourID, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int) $result['maxTicketsEnglish'];

        } else if ($language == "Dutch") {

            $stmt = $this->connection->prepare('SELECT maxTicketsDutch FROM HISTORY_TOURS WHERE InformationID = :info_id;');
            $stmt->bindParam(':info_id', $tourID, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int) $result['maxTicketsDutch'];

        } else {
            $stmt = $this->connection->prepare('SELECT maxTicketsChinese FROM HISTORY_TOURS WHERE InformationID = :info_id;');
            $stmt->bindParam(':info_id', $tourID, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int) $result['maxTicketsChinese'];
        }
    }

    public function countDanceTicketsReserved(int $danceTicketID, int $OrderToIgnoreID): int
    {
        $stmt = $this->connection->prepare('SELECT DanceTicket_FK, 
                                            SUM(Quantity) AS TotalQuantity
                                            FROM ORDER_ITEM WHERE 
                                            DanceTicket_FK IS NOT NULL AND DanceTicket_FK = :dance_ticket_id AND Order_FK != :order_to_ignore_id
                                            GROUP BY DanceTicket_FK;');
        $stmt->bindParam(':dance_ticket_id', $danceTicketID, PDO::PARAM_INT);
        $stmt->bindParam(':order_to_ignore_id', $OrderToIgnoreID, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) $result['TotalQuantity'];
    }

    public function countMaxPassesReserved(int $passID, int $OrderToIgnoreID): int
    {
        $stmt = $this->connection->prepare('SELECT Pass_FK, 
                                            SUM(Quantity) AS TotalQuantity
                                            FROM ORDER_ITEM WHERE 
                                            Pass_FK IS NOT NULL AND Pass_FK = :pass_id AND Order_FK != :order_to_ignore_id
                                            GROUP BY Pass_FK;');
        $stmt->bindParam(':pass_id', $passID, PDO::PARAM_INT);
        $stmt->bindParam(':order_to_ignore_id', $OrderToIgnoreID, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) $result['TotalQuantity'];
    }

    public function getAllDancePasses(): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM DANCE_PASSES');
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(function ($row) {
            return new DancePasses(
                $row['PassesID'],
                $row['Price'],
                $row['Date'],
                $row['AllDayPass'],
                $row['MaxPasses'],
                $row['MaxAllDayPasses']
            );
        }, $result);

    }

    public function getAllDanceTickets(): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM DANCE_TICKET');
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(function ($row) {
            return new DanceTicket(
                $row['D_TicketID'],
                $row['DateAndTime'],
                $row['Location'],
                $row['Price'],
                $row['Singer'],
                $row['TotalQuantityOfAvailableTickets'],
                $row['SessionType'],
                $row['StartTime'],
                $row['EndTime']
            );
        }, $result);
    }

    public function editDancePasses($id, $price, ?string $date, ?bool $allDayPass, ?int $maxPasses, ?int $maxAllDayPasses): void
    {
        $stmt = $this->connection->prepare('UPDATE DANCE_PASSES SET Price = :price, Date = :date, AllDayPass = :all_day_pass, MaxPasses = :max_passes, MaxAllDayPasses = :max_all_day_passes WHERE PassesID = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':all_day_pass', $allDayPass, PDO::PARAM_BOOL);
        $stmt->bindParam(':max_passes', $maxPasses, PDO::PARAM_INT);
        $stmt->bindParam(':max_all_day_passes', $maxAllDayPasses, PDO::PARAM_INT);
        $stmt->execute();

    }

    public function changeTicketDanceLocationName($name, $currentName): void
    {
        $stmt = $this->connection->prepare('UPDATE DANCE_TICKET SET Location = :name WHERE Location = :currentName');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':currentName', $currentName, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function editDanceTickets($id, $date, $location, $price, $singer, $totalQuantityAvailable, $sessionType, $startTime, $endTime): void
    {
        $stmt = $this->connection->prepare('UPDATE DANCE_TICKET SET DateAndTime = :date, Location = :location, Price = :price, Singer = :singer,
                                            TotalQuantityOfAvailableTickets = :total_quantity_available, SessionType = :session_type, StartTime = :start_time,
                                            EndTime = :end_time WHERE D_TicketID = :id');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':location', $location, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':singer', $singer, PDO::PARAM_STR);
        $stmt->bindParam(':total_quantity_available', $totalQuantityAvailable, PDO::PARAM_INT);
        $stmt->bindParam(':session_type', $sessionType, PDO::PARAM_STR);
        $stmt->bindParam(':start_time', $startTime, PDO::PARAM_STR);
        $stmt->bindParam(':end_time', $endTime, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function deleteDancePasses($id): void
    {
        $stmt = $this->connection->prepare('DELETE FROM DANCE_PASSES WHERE PassesID = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function deleteDanceTickets($id): void
    {
        $stmt = $this->connection->prepare('DELETE FROM DANCE_TICKET WHERE D_TicketID = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function addDancePasses($price, $date = null, $allDayPass = false, $maxPasses = null, $maxAllDayPasses = null): void
    {
        $stmt = $this->connection->prepare('INSERT INTO DANCE_PASSES (Price, Date, AllDayPass, MaxPasses, MaxAllDayPasses) VALUES (:price, :date, :all_day_pass, :max_passes, :max_all_day_passes)');
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':all_day_pass', $allDayPass, PDO::PARAM_BOOL);
        $stmt->bindParam(':max_passes', $maxPasses, PDO::PARAM_INT);
        $stmt->bindParam(':max_all_day_passes', $maxAllDayPasses, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function addDanceTicket($date, $location, $price, $singer, $totalQuantityAvailable, $sessionType, $startTime, $endTime): void
    {
        $stmt = $this->connection->prepare('INSERT INTO DANCE_TICKET (DateAndTime, Location, Price, Singer, TotalQuantityOfAvailableTickets, SessionType, StartTime, EndTime) VALUES (:date, :location, :price, :singer, :total_quantity_available, :session_type, :start_time, :end_time)');
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':location', $location, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':singer', $singer, PDO::PARAM_STR);
        $stmt->bindParam(':total_quantity_available', $totalQuantityAvailable, PDO::PARAM_INT);
        $stmt->bindParam(':session_type', $sessionType, PDO::PARAM_STR);
        $stmt->bindParam(':start_time', $startTime, PDO::PARAM_STR);
        $stmt->bindParam(':end_time', $endTime, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function addHistoryTicket($date, $language, $typeOfTicket, $tourID, $routeID = 1): int
    {
        $stmt = $this->connection->prepare('INSERT INTO HISTORY_TICKET (DateAndTime, Language, TypeOfTicket, RouteID, TourID) VALUES (:date, :language, :type_of_ticket, :route_id, :tour_id)');
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':language', $language, PDO::PARAM_STR);
        $stmt->bindParam(':type_of_ticket', $typeOfTicket, PDO::PARAM_STR);
        $stmt->bindParam(':route_id', $routeID, PDO::PARAM_INT);
        $stmt->bindParam(':tour_id', $tourID, PDO::PARAM_INT);
        $stmt->execute();

        return $this->connection->lastInsertId();
    }



}