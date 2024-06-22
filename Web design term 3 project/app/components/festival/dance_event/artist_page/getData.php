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

$artistId = $_GET['artistID'];
$artist = $danceService->getArtistById($artistId);
$careerHighlights = $danceService->getCareerHighlightsByArtistID($artistId);
$spotifyLinks = $danceService->getArtistSpotifyLinks($artistId);

$displayMore = true;

$concertsAll = $danceService->getConcertsByArtistName($artist->name);
$concertsWithTripleArtist = [];
$simpleConcert = [];

foreach ($concertsAll as $concert) {
    if ($concert->sessionType == "Triple Artist") {
        $concertsWithTripleArtist[] = $concert;
    } else {
        $simpleConcert[] = $concert;
    }
}

if (count($concertsWithTripleArtist) > 0 && count($simpleConcert) >= 2) {
    $displayMore = false;
}

?>