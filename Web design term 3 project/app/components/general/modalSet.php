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
    error_log(print_r("\n The error is gottern : " . $error, true), 3, __DIR__ . '/../../file_with_erros_logs'); // Log the input data
}

?>