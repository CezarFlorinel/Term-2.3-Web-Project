<?php
use App\Services\HistoryService;

$historyService = new HistoryService();

$historyTopPart = $historyService->getHistoryTopParts();
$historyRoutes = $historyService->getHistoryRoutes();
$historyTourStartingPoints = $historyService->getHistoryTourStartingPoints();
$firstHistoryRoute = $historyRoutes[0];
$historyTickets = $historyService->getHistoryTicketPrices();
$firstHistoryTicket = $historyTickets[0];
$secondHistoryTicket = $historyTickets[1];
$historyTourDeparturesTimetables = $historyService->getHistoryTourDeparturesTimetables();
$historyTours = $historyService->getHistoryTours();
$historyPracticalInformation = $historyService->getHistoryPracticalInformation();
$arrayWithImagePathsCarousel = $historyService->returnImagePathsForCarousel();

?>