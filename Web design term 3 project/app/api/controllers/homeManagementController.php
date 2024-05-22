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
                parse_str(file_get_contents("php://input"), $_POST);

                if (isset($_POST['id'], $_POST['description'], $_POST['link'], $_POST['subtitle']) && isset($_FILES['image'])) {
                    $id = $_POST['id'];
                    $description = $_POST['description'];
                    $link = $_POST['link'];
                    $subtitle = $_POST['subtitle'];
                    $image = $_FILES['image'];

                    // Save the uploaded image
                    $imagePath = ImageEditor::saveImage('/app/public/assets/images/home_page_images/events_details', $image);

                    $this->homeService->updateEvent($id, $imagePath, $description, $link, $subtitle);

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