<?php
use App\Services\DanceService;
use App\Services\TicketsService;
use App\Services\PaymentService;


$ticketService = new TicketsService();
$danceService = new DanceService();
$paymentService = new PaymentService();

$userID = 2; // TODO: get the user id from the session
$order = $paymentService->getOrderByUserId($userID);

$imagePathTop = $danceService->getImageHomePage()->imagePath;
$clubLocations = $danceService->getAllClubLocations();
$artists = $danceService->getAllArtists();

$danceTickets = $ticketService->getAllDanceTickets();
$dancePasses = $ticketService->getAllDancePasses();

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