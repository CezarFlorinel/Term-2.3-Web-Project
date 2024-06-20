<?php
use App\Services\TicketsService;
use App\Services\DanceService;

$ticketService = new TicketsService();
$danceService = new DanceService();
$danceTickets = $ticketService->getAllDanceTickets();
$dancePasses = $ticketService->getAllDancePasses();
$locations = $danceService->getAllClubLocationStrings();

$oneDayPasses = [];
$multipleDayPasses = [];

foreach ($dancePasses as $pass) {
    if ($pass->allDayPass == false) {
        $oneDayPasses[] = $pass;
    } else {

        $multipleDayPasses[] = $pass; // usually only one pass, can be extended to hold more passes

    }
}

?>


<!DOCTYPE html>
<html lang="en">

<?php require __DIR__ . '/../../../components/admin/header.php'; ?>

<body class="bg-gray-200">
    <div class="flex min-h-screen overflow-hidden">

        <?php require __DIR__ . '/../../../components/admin/sidebar.php'; ?>

        <div class="flex-grow p-6 ml-36">
            <h1 class="text-3xl text-center mb-6">Dance Tickets & Passes Management</h1>

            <h2 class="text-2xl text-center mb-6">Tickets</h2>

            <p class="bg-white shadow-lg mb-3 text-center text-red-600">Please note that when editing/creating new
                tickets, you need to
                properly
                write the name of the artist. <br> For adding more artists use " / " to separate them </p>


            <?php require __DIR__ . '/../../../components/festival/dance_event/admin/ticket_management/normalTickets.php'; ?>
            <?php require __DIR__ . '/../../../components/festival/dance_event/admin/ticket_management/oneDayPass.php'; ?>
            <?php require __DIR__ . '/../../../components/festival/dance_event/admin/ticket_management/multipleDayPass.php'; ?>

        </div>
    </div>

    <script type="module" src="javascript/Dance/manage_dance_tickets.js"></script>

</body>

</html>