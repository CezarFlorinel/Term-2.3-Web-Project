<?php

namespace App\Utilities;

class SessionManager
{
    public function setError($message)
    {
        $_SESSION['error'] = $message;
    }

    public function getError()
    {
        if (isset($_SESSION['error'])) {
            $error = $_SESSION['error'];
            unset($_SESSION['error']); // clear the error after retrieving it
            return $error;
        }
        return null;
    }

}
