<?php

namespace App\Api\Controllers;

use App\Services\YummyService;
use App\Utilities\ImageEditor;
use App\Utilities\ErrorHandlerMethod;

class YummyHomeAdminController
{
    private $yummyService;

    public function __construct()
    {
        $this->yummyService = new YummyService();
        ImageEditor::initialize();
    }

    public function updateTopPartInformation()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['pageID'], $input['subheader'], $input['description'])) {
                    $id = $input['pageID'];
                    $subheader = $input['subheader'];
                    $description = $input['description'];

                    $this->yummyService->editHomepageDataRestaurant($id, $subheader, $description);

                    echo json_encode(['success' => true, 'message' => 'Top part updated successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Invalid request method']);
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }

    public function updateHomePageImages()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'], $_POST['id'], $_POST['columnName'])) {
                $image = $_FILES['image'];
                $id = $_POST['id'];
                $columnName = $_POST['columnName'];
                $currentImage = $this->yummyService->getCurrentHomepageDataRestaurantImagePath($id, $columnName);
                $imageUrl = ImageEditor::saveImage('/app/public/assets/images/yummy_event/home_page_top', $image);

                if ($imageUrl !== null) {
                    $this->yummyService->editImagePathHomepageDataRestaurant($id, $columnName, $imageUrl);
                    if ($currentImage && $currentImage != $imageUrl) {
                        ImageEditor::deleteImage($currentImage);
                    }
                    echo json_encode(['success' => true, 'imageUrl' => $imageUrl]);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Invalid file or upload error.']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'No file uploaded or missing ID.']);
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }


    }
    public function updateReservation()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "PUT") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['reservationId'], $input['firstName'], $input['lastName'], $input['email'], $input['phoneNumber'], $input['session'], $input['date'], $input['numberOfAdults'], $input['numberOfChildren'], $input['comment'], $input['active'])) {
                    $id = $input['reservationId'];
                    $firstName = $input['firstName'];
                    $lastName = $input['lastName'];
                    $email = $input['email'];
                    $phoneNumber = $input['phoneNumber'];
                    $session = $input['session'];
                    $date = $input['date'];
                    $numberOfAdults = (int) $input['numberOfAdults'];
                    $numberOfChildren = (int) $input['numberOfChildren'];
                    $comment = $input['comment'];
                    $active = $input['active'];

                    $this->yummyService->editReservation($id, $firstName, $lastName, $email, $phoneNumber, $session, $date, $numberOfAdults, $numberOfChildren, $comment, $active);

                    echo json_encode(['success' => true, 'message' => 'Reservation updated successfully $numberOfAdults' . $numberOfAdults . ' $numberOfChildren' . $numberOfChildren]);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Invalid request method']);
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }
    public function createReservation()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['restaurantName'], $input['firstName'], $input['lastName'], $input['email'], $input['phoneNumber'], $input['session'], $input['date'], $input['numberOfAdults'], $input['numberOfChildren'], $input['comment'], $input['active'])) {
                    $restaurantName = $input['restaurantName'];
                    $firstName = $input['firstName'];
                    $lastName = $input['lastName'];
                    $email = $input['email'];
                    $phoneNumber = $input['phoneNumber'];
                    $session = $input['session'];
                    $date = $input['date'];
                    $numberOfAdults = (int) $input['numberOfAdults'];
                    $numberOfChildren = (int) $input['numberOfChildren'];
                    $comment = $input['comment'];
                    $active = $input['active'];


                    $restaurantId = $this->yummyService->getRestaurantIdByName($restaurantName);
                    $this->yummyService->addReservation($restaurantId, $firstName, $lastName, $email, $phoneNumber, $session, $date, $numberOfAdults, $numberOfChildren, $comment, $active);

                    echo json_encode(['success' => true, 'message' => 'Reservation updated successfully $numberOfAdults' . $numberOfAdults . ' $numberOfChildren' . $numberOfChildren]);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Invalid request method']);
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }
    public function getSessionByRestaurantName()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['name'])) {
                $restaurantName = $_GET['name'];

                $sessions = $this->yummyService->getSessionByRestaurantName($restaurantName);

                header('Content-Type: application/json');
                echo json_encode($sessions);
            } else {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Missing required parameters']);
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }

}