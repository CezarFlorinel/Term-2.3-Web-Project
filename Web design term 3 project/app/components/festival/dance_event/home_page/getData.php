<?php
use App\Services\DanceService;
use App\Services\TicketsService;
use App\Services\PaymentService;

session_start();

$ticketService = new TicketsService();
$danceService = new DanceService();
$paymentService = new PaymentService();

$userID = null;
$allowOrder = false;
$order = null;

if (isset($_SESSION['userId'])) {
    $userID = $_SESSION['userId'];
    $allowOrder = true;
    $order = $paymentService->getOrderByUserId($userID);
}



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