<?php
use App\Services\HomeService;
use App\Services\UserService;

$homeService = new HomeService();
$userService = new UserService();

$events = $homeService->getEvents();
$festivalLocation = $homeService->getHomeFestivalLocation();
$homePageDetails = $homeService->getHomePageDetails();
$homeGameEventDetails = $homeService->getHomeGameEventDetails();

$eventsWithLinks = []; // for middle part of the page with redirect link
$eventsWithoutLinks = []; // for bottom part of the page

foreach ($events as $event) {
  if ($event->linkToRedirect !== null) {
    $eventsWithLinks[] = $event;
  } else {
    $eventsWithoutLinks[] = $event;
  }
}

$isAdmin = false;
$userID = 1; // hardcoded for now
$user = $userService->getById($userID);

if ($user !== null && $user->role === 'admin') {
  $isAdmin = true;
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Harlem Festival</title>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>



  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display|Vampiro+One&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="CSS_files/home.css">
</head>

<body class="antialiased font-'Open Sans'">
  <?php include __DIR__ . '/../header.php'; ?>




  <?php if ($isAdmin): ?>
    <?php include __DIR__ . '/../../components/home/for_admin_editor/eventsDescriptionWithEditor.php'; ?>



  <?php else: ?>
    <?php include __DIR__ . '/../../components/home/for_user/topPart.php'; ?>
    <?php include __DIR__ . '/../../components/home/for_user/eventsDescription.php'; ?>
    <?php include __DIR__ . '/../../components/home/for_user/location.php'; ?>
    <?php include __DIR__ . '/../../components/home/dates.php'; ?> <!-- Dates, add in is admin as well -->
    <?php include __DIR__ . '/../../components/home/for_user/bottomEventsDescription.php'; ?>
    <?php include __DIR__ . '/../../components/home/for_user/mobileEvent.php'; ?>
  <?php endif; ?>


  <div style="height: 40px;"></div>
  <?php include __DIR__ . '/../footer.php'; ?>
  </div>

  <script type="module" src="javascript/Home/home_management.js"></script>
</body>

</html>