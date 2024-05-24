<?php
use App\Services\UserService;

$userService = new UserService();
// add check if it's user or admin and insert different top bar and side bar

$isAdmin = false;
$userID = 2; // hardcoded for now
$user = $userService->getById($userID);

if ($user !== null && $user['Role'] === 'Admin') {
    $isAdmin = true;
}

?>

<h1> this is the custom page</h1>