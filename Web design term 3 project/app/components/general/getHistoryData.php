<?php
use App\Services\HistoryService;

$historyService = new HistoryService();

$historyTopPart = $historyService->getHistoryTopParts();
$arrayWithImagePathsCarousel = $historyService->returnImagePathsForCarousel();
$historyRoutes = $historyService->getHistoryRoutes();
$firstHistoryRoute = $historyRoutes[0];
$historyTourStartingPoints = $historyService->getHistoryTourStartingPoints();
$historyTickets = $historyService->getHistoryTicketPrices();
$firstHistoryTicket = $historyTickets[0];
$secondHistoryTicket = $historyTickets[1];
$historyTourDeparturesTimetables = $historyService->getHistoryTourDeparturesTimetables();
$historyTours = $historyService->getHistoryTours();
$historyPracticalInformation = $historyService->getHistoryPracticalInformation();


?>