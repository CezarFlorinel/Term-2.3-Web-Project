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

                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['id']) && isset($input['description']) && isset($input['link']) && isset($input['subtitle'])) {
                    $id = filter_var($input['id'], FILTER_SANITIZE_NUMBER_INT);
                    $description = $input['description'];
                    $link = $input['link'];
                    $subtitle = $input['subtitle'];

                    $this->homeService->updateEvent($id, $description, $link, $subtitle);

                    echo json_encode(['success' => true, 'message' => 'Event Information updated successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }
        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }




}