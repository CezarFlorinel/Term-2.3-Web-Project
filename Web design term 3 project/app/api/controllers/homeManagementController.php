<?php

namespace App\Api\Controllers;

use App\Services\HomeService;
use App\Utilities\ImageEditor;
use App\Utilities\ErrorHandlerMethod;
use Exception;

class HomeManagementController
{
    private $homeService;

    public function __construct()
    {
        $this->homeService = new HomeService();
        ImageEditor::initialize();
    }

    public function updateEventInformation()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
                // Decode the JSON input
                $input = json_decode(file_get_contents('php://input'), true);

                // Log the input data
                error_log(print_r($input, true), 3, __DIR__ . '/../../file_with_errors_logs.log');

                // Check for required fields
                if (isset($input['id']) && isset($input['description']) && isset($input['link']) && isset($input['subtitle'])) {
                    $id = $input['id'];
                    $description = $input['description'];
                    $link = $input['link'];
                    $subtitle = $input['subtitle'];

                    // Update the event (assuming $this->homeService->updateEvent() is a valid method)
                    $this->homeService->updateEvent($id, $description, $link, $subtitle);

                    // Respond with success
                    echo json_encode(['success' => true, 'message' => 'Event Information updated successfully']);
                } else {
                    // Respond with error if required fields are missing
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                // Respond with error if method is not allowed
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }
        } catch (Exception $e) {
            // Handle exceptions
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }




}