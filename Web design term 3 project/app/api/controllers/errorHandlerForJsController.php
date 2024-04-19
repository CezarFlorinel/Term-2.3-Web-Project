<?php
namespace App\Api\Controllers;

use App\Utilities\ErrorHandlerMethod;

class ErrorHandlerForJsController
{
    public function storeError()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $input = json_decode(file_get_contents('php://input'), true);
                if (isset($input['error'], $input['methodeName'], $input['className'])) {
                    $error = $input['error'];
                    $methodeName = $input['methodeName'];
                    $className = $input['className'];
                    error_log(date('Y-m-d H:i:s') . " - " . $className . " - " . $methodeName . " - " . $error . "\n", 3, __DIR__ . '/../../error_logs/error_log_javascript.log');
                    echo json_encode(['success' => true, 'message' => 'Error has been stored']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'message' => 'Error is required']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Only POST method is supported']);
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }

    }
}


