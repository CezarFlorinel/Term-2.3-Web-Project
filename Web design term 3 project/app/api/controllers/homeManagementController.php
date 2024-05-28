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

                if (isset($input['id']) && isset($input['description']) && isset($input['subtitle'])) {
                    $id = filter_var($input['id'], FILTER_SANITIZE_NUMBER_INT);
                    $description = $input['description'];

                    if (isset($input['link'])) { // to make it work for the bottom ones as well which don't have a link
                        $link = $input['link'];
                    } else {
                        $link = null;
                    }

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

    public function updateHomeFestivalLocation()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "PATCH") {

                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['id']) && isset($input['description'])) {
                    $id = filter_var($input['id'], FILTER_SANITIZE_NUMBER_INT);
                    $description = $input['description'];

                    $this->homeService->updateHomeFestivalLocation($id, $description);

                    echo json_encode(['success' => true, 'message' => 'Festival Location updated successfully']);
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

    public function updateHomePageDetails()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "PATCH") {

                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['id']) && isset($input['title']) && isset($input['description'])) {
                    $id = filter_var($input['id'], FILTER_SANITIZE_NUMBER_INT);
                    $title = $input['title'];
                    $description = $input['description'];

                    $this->homeService->updateHomePageDetails($id, $title, $description);

                    echo json_encode(['success' => true, 'message' => 'Home Page Details updated successfully']);
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

    public function updateHomeGameEventDetails()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "PATCH") {

                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['id']) && isset($input['description']) && isset($input['title']) && isset($input['subtitle'])) {
                    $id = filter_var($input['id'], FILTER_SANITIZE_NUMBER_INT);
                    $description = $input['description'];
                    $title = $input['title'];
                    $subtitle = $input['subtitle'];

                    $this->homeService->updateHomeGameEventDetails($id, $description, $title, $subtitle);

                    echo json_encode(['success' => true, 'message' => 'Game Event Details updated successfully']);
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

    public function updateEventImage()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if (isset($_FILES['image'], $_POST['id'])) {
                    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
                    $image = $_FILES['image'];
                    $currentImagePath = $this->homeService->getEventById($id)->imagePath;
                    $imagePath = ImageEditor::saveImage('/app/public/assets/images/home_page_images/events_details', $image);

                    if ($imagePath !== null) {
                        $this->homeService->updateEventImage($id, $imagePath);
                        if ($currentImagePath && $currentImagePath !== $imagePath) {
                            ImageEditor::deleteImage($currentImagePath);
                        }
                    }

                    echo json_encode(['success' => true, 'imageUrl' => $imagePath, 'message' => 'Event Image updated successfully']);
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

    public function updateHomeFestivalLocationImage()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if (isset($_FILES['image'], $_POST['id'])) {
                    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
                    $image = $_FILES['image'];
                    $currentImagePath = $this->homeService->getHomeFestivalLocation()->imagePathLocation;
                    $imagePath = ImageEditor::saveImage('/app/public/assets/images/home_page_images/location', $image);

                    if ($imagePath !== null) {
                        $this->homeService->updateHomeFestivalLocationImage($id, $imagePath);
                        if ($currentImagePath && $currentImagePath !== $imagePath) {
                            ImageEditor::deleteImage($currentImagePath);
                        }
                    }

                    echo json_encode(['success' => true, 'imageUrl' => $imagePath, 'message' => 'Festival Location Image updated successfully']);
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
    public function updateHomePageDetailsImage()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if (isset($_FILES['image'], $_POST['id'])) {
                    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
                    $image = $_FILES['image'];
                    $currentImagePath = $this->homeService->getHomePageDetails()->imagePathTop;
                    $imagePath = ImageEditor::saveImage('/app/public/assets/images/home_page_images/top_image', $image);

                    if ($imagePath !== null) {
                        $this->homeService->updateHomePageDetailsImage($id, $imagePath);
                        if ($currentImagePath && $currentImagePath !== $imagePath) {
                            ImageEditor::deleteImage($currentImagePath);
                        }
                    }

                    echo json_encode(['success' => true, 'imageUrl' => $imagePath, 'message' => 'Home Page Details Image updated successfully']);
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
    public function updateHomeGameEventDetailsImage()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if (isset($_FILES['image'], $_POST['id'], $_POST['columnName'])) {
                    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
                    $image = $_FILES['image'];
                    $column = $_POST['columnName'];
                    $currentImagePath = '';

                    if ($column === 'ImageQRcodePath') {
                        $currentImagePath = $this->homeService->getHomeGameEventDetails()->imagePathQRcode;
                    } else if ($column === 'ImageDexterPath') {
                        $currentImagePath = $this->homeService->getHomeGameEventDetails()->imagePathDecorationLeft;
                    }

                    $imagePath = ImageEditor::saveImage('/app/public/assets/images/home_page_images/app_event', $image);

                    if ($imagePath !== null) {
                        $this->homeService->updateHomeGameEventDetailsImage($id, $imagePath, $column);
                        if ($currentImagePath && $currentImagePath !== $imagePath) {
                            ImageEditor::deleteImage($currentImagePath);
                        }
                    }

                    echo json_encode(['success' => true, 'imageUrl' => $imagePath, 'message' => 'Game Event Details Image updated successfully']);
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