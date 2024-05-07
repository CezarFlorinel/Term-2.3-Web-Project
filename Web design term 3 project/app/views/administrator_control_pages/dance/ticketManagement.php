<?php
use App\Services\TicketsService;

$ticketService = new TicketsService();
$dancePasses = $ticketService->getPassByID($passID);
$danceTickets = $ticketService->getDanceTicketByID($danceTicketID);


?>


<!DOCTYPE html>
<html lang="en">

<?php require __DIR__ . '/../../../components/admin/header.php'; ?>

<body class="bg-gray-200">
    <div class="flex min-h-screen overflow-hidden">

        <?php require __DIR__ . '/../../../components/admin/sidebar.php'; ?>

        <div class="flex-grow p-6">

        </div>
    </div>
</body>