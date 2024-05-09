<?php

namespace App\Api\Controllers;

use App\Services\DanceService;
use App\Utilities\ImageEditor;
use App\Utilities\ErrorHandlerMethod;
use Exception;

class DanceHomeAdminController
{
    private $danceService;

    public function __construct()
    {
        $this->danceService = new DanceService();
        ImageEditor::initialize();
    }

    public function updateImageHomePage()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'], $_POST['id'])) {
                $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
                $image = $_FILES['image'];
                $imageURL = ImageEditor::saveImage('/app/public/assets/images/dance_event/homepage_dance', $image);
                $currentImage = $this->danceService->getImageHomePage()->imagePath;

                if ($imageURL !== null) {
                    $this->danceService->updateImageHomePage($id, $imageURL);
                    if ($currentImage && $currentImage != $imageURL) {
                        ImageEditor::deleteImage($currentImage);
                    }
                    echo json_encode(['success' => true, 'imageUrl' => $imageURL]);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Invalid file or upload error.']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'No file uploaded or missing ID.']);
            }

        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }

    public function changeClubImage()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'], $_POST['id'])) {
                $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
                $image = $_FILES['image'];
                $imageURL = ImageEditor::saveImage('/app/public/assets/images/dance_event/clubs', $image);
                $currentImage = $this->danceService->getClubLocationById($id)->imagePath;

                if ($imageURL !== null) {
                    $this->danceService->updateClubLocationImage($id, $imageURL);
                    if ($currentImage && $currentImage != $imageURL) {
                        ImageEditor::deleteImage($currentImage);
                    }
                    echo json_encode(['success' => true, 'imageUrl' => $imageURL]);

                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Invalid file or upload error.']);
                }

            } else {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'No file uploaded or missing ID.']);

            }

        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }

    public function updateClubLocation()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "PUT") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['clubLocationID'], $input['name'], $input['location'], $input['currentName'])) {
                    $clubLocationID = filter_var($input['clubLocationID'], FILTER_VALIDATE_INT);
                    $name = $input['name'];
                    $location = $input['location'];
                    $currentName = $input['currentName'];

                    $this->danceService->updateClubLocation($clubLocationID, $name, $location, $currentName);

                    echo json_encode(['success' => true, 'message' => 'Club updated successfully']);
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

    public function deleteClubLocation()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['id'])) {
                    $id = filter_var($input['id'], FILTER_VALIDATE_INT);

                    $imagePath = $this->danceService->getClubLocationById($id)->imagePath;
                    if ($imagePath) {
                        ImageEditor::deleteImage($imagePath);
                    }

                    $this->danceService->deleteClubLocation($id);

                    echo json_encode(['success' => true, 'message' => 'Club deleted successfully']);
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

    public function addClubLocation()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Check if both text fields and file are present
                if (isset($_POST['name'], $_POST['location']) && isset($_FILES['image'])) {
                    $name = $_POST['name'];
                    $location = $_POST['location'];
                    $image = $_FILES['image'];

                    $imageURL = ImageEditor::saveImage('/app/public/assets/images/dance_event/club_locations', $image);

                    if ($imageURL) {
                        $this->danceService->addClubLocation($name, $location, $imageURL);
                        echo json_encode(['success' => true, 'message' => 'Club added successfully']);
                    } else {
                        http_response_code(400);
                        echo json_encode(['success' => false, 'error' => 'Invalid file or upload error.']);
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields or file']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }
        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }

    public function addArtist()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['name']) && isset($_FILES['imageTop'], $_FILES['imageArtistLineup'])) {
                    $name = $_POST['name'];
                    $imageArtistLineup = $_FILES['imageArtistLineup'];
                    $imageTop = $_FILES['imageTop'];
                    $imageURL = ImageEditor::saveImage('/app/public/assets/images/dance_event/artists', $imageArtistLineup);
                    $imageTopURL = ImageEditor::saveImage('/app/public/assets/images/dance_event/artists', $imageTop);

                    if ($imageURL && $imageTopURL) {
                        $this->danceService->addArtist($name, $imageURL, $imageTopURL);
                        echo json_encode(['success' => true, 'message' => 'Artist added successfully']);
                    } else {
                        http_response_code(400);
                        echo json_encode(['success' => false, 'error' => 'Invalid file or upload error.']);
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields or file']);
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