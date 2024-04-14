<?php

namespace App\Utilities;

class ErrorHandlerMethod
{
    public static function handleErrorApiController($e)
    {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => "A fatal error has occurred! Please Try Again Later ;D"]);
        error_log(date('Y-m-d H:i:s') . " - " . $e->getMessage() . "\n", 3, __DIR__ . '/../public/errorLogs/errorLogApis.txt');
    }

    public static function serverIsNotPostMethodCheck($sessionManager, $location, $serverReqestMethod)
    {
        if ($serverReqestMethod !== 'POST') {
            $sessionManager->setError("Invalid request. Please try again.");
            header('Location: ' . $location);
            exit();
        }
    }

    public static function handleErrorController($e, $sessionManager, $location)
    {
        $sessionManager->setError("An error occurred. Please try again.");
        error_log(date('Y-m-d H:i:s') . " - " . $e->getMessage() . "\n", 3, __DIR__ . '/../public/errorLogs/errorLogControllers.txt');
        header('Location: ' . $location);
        exit();
    }
}