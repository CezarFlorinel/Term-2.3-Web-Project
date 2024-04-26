<?php

namespace App\Utilities;

class SessionManager
{
    public function setError($message)
    {
        $_SESSION['error'] = $message;
    }

    public function setSuccess($message)
    {
        $_SESSION['successMessage'] = $message;
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

    public function getSuccess()
    {
        if (isset($_SESSION['successMessage'])) {
            $success = $_SESSION['successMessage'];
            unset($_SESSION['successMessage']); // clear the success message after retrieving it
            return $success;
        }
        return null;
    }

}
