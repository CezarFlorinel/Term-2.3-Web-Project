<?php

// /\
// ||  a session start is needed to start the session

// code for creating the moddal box
use App\Utilities\SessionManager;
use App\Utilities\Modal;

$sessionManager = new SessionManager();
$error = $sessionManager->getError();
if ($error) {
    $errorModal = new Modal('errorModal', htmlspecialchars($error));
}
$success = $sessionManager->getSuccess();
if ($success) {
    $successModal = new Modal('successModal', htmlspecialchars($success));
}


?>