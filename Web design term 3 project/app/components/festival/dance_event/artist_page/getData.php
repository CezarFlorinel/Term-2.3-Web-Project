<?php
use App\Services\DanceService;
use App\Services\TicketsService;
use App\Services\PaymentService;

$ticketService = new TicketsService();
$danceService = new DanceService();
$paymentService = new PaymentService();

$userID = 2; // TODO: get the user id from the session
$order = $paymentService->getOrderByUserId($userID);

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