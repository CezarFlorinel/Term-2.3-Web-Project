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
$userID = 2; //TODO: hardcoded for now
$user = $userService->getById($userID);

if ($user !== null && $user['Role'] === 'Admin') {
  $isAdmin = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


  <?php require __DIR__ . '/../../components/general/commonDataHeaderTailwind.php'; ?>

  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display|Vampiro+One&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" href="/assets/images/Logos/H.png">
  <link rel="stylesheet" href="CSS_files/home.css">
</head>

<body class="antialiased font-'Open Sans'">
  <?php require __DIR__ . '/../../components/general/topBar.php'; ?>

  <?php if ($isAdmin): ?>
    <?php include __DIR__ . '/../../components/home/for_admin_editor/topPart.php'; ?>
    <?php include __DIR__ . '/../../components/home/for_admin_editor/eventsDescriptionWithEditor.php'; ?>
    <?php include __DIR__ . '/../../components/home/for_admin_editor/location.php'; ?>
    <?php include __DIR__ . '/../../components/home/dates.php'; ?>
    <?php include __DIR__ . '/../../components/home/for_admin_editor/bottomEventsDescription.php'; ?>
    <?php include __DIR__ . '/../../components/home/for_admin_editor/mobileEvent.php'; ?>
  <?php else: ?>
    <?php include __DIR__ . '/../../components/home/for_user/topPart.php'; ?>
    <?php include __DIR__ . '/../../components/home/for_user/eventsDescription.php'; ?>
    <?php include __DIR__ . '/../../components/home/for_user/location.php'; ?>
    <?php include __DIR__ . '/../../components/home/dates.php'; ?>
    <?php include __DIR__ . '/../../components/home/for_user/bottomEventsDescription.php'; ?>
    <?php include __DIR__ . '/../../components/home/for_user/mobileEvent.php'; ?>
  <?php endif; ?>


  <div style="height: 40px;"></div>
  <?php include __DIR__ . '/../../components/general/footer.php'; ?>
  </div>

  <script type="module" src="javascript/Home/home_management.js"></script>
</body>

</html>