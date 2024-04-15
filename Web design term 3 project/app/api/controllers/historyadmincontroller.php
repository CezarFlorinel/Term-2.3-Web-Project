<?php

namespace App\Api\Controllers;

use App\Services\HistoryService;
use App\Utilities\ImageEditor;
use App\Utilities\ErrorHandlerMethod;
use Exception;

class HistoryAdminController
{
    private $historyService;
    private $imageEditor;

    public function __construct()
    {
        $this->historyService = new HistoryService();
        ImageEditor::initialize();
    }

    public function uploadNewImageCarousel()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'], $_POST['id'])) {
                $image = $_FILES['image'];
                $id = $_POST['id'];

                $imageUrl = ImageEditor::saveImage("/app/public/assets/images/history_event/top_part", $image);

                if ($imageUrl !== null) {
                    $this->historyService->editImagePathHistoryTopPart($id, $imageUrl);
                    echo json_encode(['success' => true, 'imageUrl' => '/' . $imageUrl]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Invalid file or upload error.']);
                }
            } else {
                echo json_encode(['success' => false, 'error' => 'No file uploaded or missing ID.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'An error occurred while processing the request.']);
            error_log(print_r($e->getMessage(), true), 3, __DIR__ . '/../../file_with_erros_logs');
        }
    }

    public function deleteImageFromCarousel()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($data['id'], $data['imagePath'])) {
            $id = $data['id'];
            $imageToDelete = $data['imagePath'];

            $pathForSQLdelete = 'assets/images/' . $imageToDelete;

            ImageEditor::deleteImage($pathForSQLdelete);

            $resultString = $this->remakeImageCarouselStringForDeletion($pathForSQLdelete);

            $this->historyService->editImagePathHistoryDelete($id, $resultString);

            echo json_encode(['success' => true, 'message' => 'Image deleted successfully from both the server and the database.']);

        } else {
            echo json_encode(['success' => false, 'error' => 'Missing ID or imagePath.']);
        }
    }
    function remakeImageCarouselStringForDeletion($imageToDelete)
    {
        $topPart = $this->historyService->getHistoryTopParts();
        $currentImagePathString = $topPart->imagePath;

        $imagePaths = explode(" ; ", $currentImagePathString);

        // Remove the specific image path
        $updatedImagePaths = array_filter($imagePaths, function ($path) use ($imageToDelete) {
            return trim($path) !== trim($imageToDelete);
        });

        // Convert the array back to string
        $updatedImagePathString = implode(" ; ", $updatedImagePaths);

        return $updatedImagePathString;

    }
    public function updateTopPartInformation()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = json_decode(file_get_contents('php://input'), true);

            if (isset($input['informationID'], $input['subheader'], $input['description'])) {
                $id = $input['informationID'];
                $subheader = $input['subheader'];
                $description = $input['description'];

                $this->historyService->editHistoryTopPart($id, $subheader, $description);

                echo json_encode(['message' => 'Top part updated successfully']);
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Missing required fields']);
            }
        }
    }
    public function updateHistoryToursImages()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'], $_POST['id'])) {
            $image = $_FILES['image'];
            $id = $_POST['id'];
            $currentImage = $this->historyService->getCurrentImagePathRoute($id);
            $imageUrl = ImageEditor::saveImage("/app/public/assets/images/history_event/tours", $image);

            if ($imageUrl !== null) { {
                    $this->historyService->editImagePathHistoryRoute($id, $imageUrl);

                    if ($currentImage && $currentImage != $imageUrl) {
                        ImageEditor::deleteImage($currentImage);
                    }
                    echo json_encode(['success' => true, 'imageUrl' => $imageUrl]);
                }
            } else {
                echo json_encode(['success' => false, 'error' => 'Invalid file or upload error.']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'No file uploaded or missing ID.']);
        }
    }
    public function updateHistoryRouteInformation()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = json_decode(file_get_contents('php://input'), true);

            if (isset($input['informationID'], $input['locationName'], $input['locationDescription'], $input['wheelchairSupport'])) {
                $id = $input['informationID'];
                $locationName = $input['locationName'];
                $locationDescription = $input['locationDescription'];
                $wheelchairSupport = $input['wheelchairSupport'];

                $this->historyService->editHistoryRoute($id, $locationName, $locationDescription, $wheelchairSupport);

                echo json_encode(['message' => 'Route updated successfully']);
            } else {
                http_response_code(400); // Bad Request
                echo json_encode(['message' => 'Missing required fields']);
            }
        }
    }
    public function updateHistoryTicketPricesInformation()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = json_decode(file_get_contents('php://input'), true);

            if (isset($input['informationID'], $input['type'], $input['price'], $input['description'])) {
                $id = $input['informationID'];
                $ticketType = $input['type'];
                $price = $input['price'];
                $description = $input['description'];

                $this->historyService->editHistoryTicketPrices($id, $ticketType, $price, $description);

                echo json_encode(['message' => 'Ticket price updated successfully']);
            } else {
                http_response_code(400); // Bad Request
                echo json_encode(['message' => 'Missing required fields']);
            }
        }
    }
    public function updateHistoryTicketPricesImages()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'], $_POST['id'])) {
            $image = $_FILES['image'];
            $id = $_POST['id'];
            $currentImage = $this->historyService->getCurrentImagePathTicketPrices($id);
            $imageUrl = ImageEditor::saveImage('/app/public/assets/images/history_event/tickets_types', $image);

            if ($imageUrl !== null) {
                $this->historyService->editImagePathHistoryTicketPrices($id, $imageUrl);

                if ($currentImage && $currentImage != $imageUrl) {
                    ImageEditor::deleteImage($currentImage);
                }
                echo json_encode(['success' => true, 'imageUrl' => $imageUrl]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Invalid file or upload error.']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'No file uploaded or missing ID.']);
        }
    }
    public function updateHistoryTourDeparturesTimetable()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = json_decode(file_get_contents('php://input'), true);

            if (isset($input['informationID'], $input['date'])) {
                $id = $input['informationID'];
                $date = $input['date'];

                $this->historyService->editHistoryTourDeparturesTimetables($id, $date);

                echo json_encode(['message' => 'Timetable updated successfully']);
            } else {
                http_response_code(400); // Bad Request
                echo json_encode(['message' => 'Missing required fields']);
            }
        }
    }

    public function updateHistoryTour()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = json_decode(file_get_contents('php://input'), true);

            if (isset($input['informationID'], $input['startTime'], $input['englishTour'], $input['dutchTour'], $input['chineseTour'])) {
                $id = $input['informationID'];
                $startTime = $input['startTime'];
                $englishTour = $input['englishTour'];
                $dutchTour = $input['dutchTour'];
                $chineseTour = $input['chineseTour'];

                $this->historyService->editHistoryTours($id, $startTime, $englishTour, $dutchTour, $chineseTour);

                echo json_encode(['message' => 'Tour updated successfully']);
            } else {
                http_response_code(400); // Bad Request
                echo json_encode(['message' => 'Missing required fields']);
            }
        }
    }

    public function uploadAndUpdateImageForTourStartingPoint()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'], $_POST['id'], $_POST['columnName'])) {
            $image = $_FILES['image'];
            $id = $_POST['id'];
            $columnName = $_POST['columnName'];
            $currentImage = $this->historyService->getCurrentImagePathTourStartingPoint($id, $columnName);
            $imageUrl = ImageEditor::saveImage("/app/public/assets/images/history_event/starting_point", $image);

            if ($imageUrl !== null) {
                $this->historyService->editImagePathsTourStartingPoint($id, $imageUrl, $columnName);

                if ($currentImage && $currentImage != $imageUrl) {
                    ImageEditor::deleteImage($currentImage);
                }
                echo json_encode(['success' => true, 'imageUrl' => $imageUrl]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Invalid file or upload error.']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'No file uploaded or missing ID.']);
        }
    }

    public function updateHistoryTourStartingPointDescription()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = json_decode(file_get_contents('php://input'), true);

            if (isset($input['informationID'], $input['description'])) {
                $id = $input['informationID'];
                $description = $input['description'];

                $this->historyService->editHistoryTourStartingPoint($id, $description);

                echo json_encode(['message' => 'Starting point updated successfully']);
            } else {
                http_response_code(400); // Bad Request
                echo json_encode(['message' => 'Missing required fields']);
            }
        }
    }

    public function updateHistoryPracticalInformation()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = json_decode(file_get_contents('php://input'), true);

            if (isset($input['informationID'], $input['question'], $input['answer'])) {
                $id = $input['informationID'];
                $question = $input['question'];
                $answer = $input['answer'];

                $this->historyService->editHistoryPracticalInformation($id, $question, $answer);

                echo json_encode(['message' => 'Information updated successfully']);
            } else {
                http_response_code(400); // Bad Request
                echo json_encode(['message' => 'Missing required fields']);
            }
        }
    }

    public function createHistoryPracticalInformation()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = json_decode(file_get_contents('php://input'), true);

            if (isset($input['question'], $input['answer'])) {
                $question = $input['question'];
                $answer = $input['answer'];

                $this->historyService->addHistoryPracticalInformation($question, $answer);

                echo json_encode(['message' => 'New information added successfully']);
            } else {

                http_response_code(400); // Bad Request
                echo json_encode(['message' => 'Missing required fields']);
            }
        }
    }

    public function deleteHistoryPracticalInformation()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = json_decode(file_get_contents('php://input'), true);

            if (isset($input['informationID'])) {
                $id = $input['informationID'];

                $this->historyService->deleteHistoryPracticalInformation($id);

                echo json_encode(['message' => 'Information deleted successfully']);
            } else {

                http_response_code(400); // Bad Request
                echo json_encode(['message' => 'Missing required field: informationID']);
            }
        }
    }


}