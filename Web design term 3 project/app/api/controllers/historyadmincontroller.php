<?php

namespace App\Api\Controllers;

use App\Services\HistoryService;

class HistoryAdminController
{
    private $historyService;

    public function __construct()
    {
        $this->historyService = new HistoryService();
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

            $projectRoot = realpath(__DIR__ . '/../../..');
            $uploadsDir = $projectRoot . '/app/public/assets/images/history_event/tickets_types';
            if (!file_exists($uploadsDir)) {
                mkdir($uploadsDir, 0777, true);
            }
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];

            if ($image['error'] === UPLOAD_ERR_OK && in_array($image['type'], $allowedTypes)) {
                $currentImage = $this->historyService->getCurrentImagePathTicketPrices($id);
                $tmpName = $image['tmp_name'];
                $name = uniqid() . '-' . basename($image['name']);
                $destination = $uploadsDir . '/' . $name;

                if (move_uploaded_file($tmpName, $destination)) {
                    $imageUrl = "/assets/images/history_event/tickets_types/$name";
                    $this->historyService->editImagePathHistoryTicketPrices($id, $imageUrl);

                    if ($currentImage && $currentImage != $imageUrl) {
                        @unlink($projectRoot . '/app/public/' . $currentImage);
                    }
                    echo json_encode(['success' => true, 'imageUrl' => $imageUrl]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Failed to save the file.']);
                }
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
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'], $_POST['id'], $_POST['imageId'])) {
            $image = $_FILES['image'];
            $id = $_POST['id'];
            $imageId = $_POST['imageId']; // Identifying which image (image1 or image2)
            $columnName = $imageId == 'image1' ? 'MainImagePath' : 'SecondaryImagePath';

            $projectRoot = realpath(__DIR__ . '/../../..');
            $uploadsDir = $projectRoot . '/app/public/assets/images/history_event/starting_point';
            if (!file_exists($uploadsDir)) {
                mkdir($uploadsDir, 0777, true);
            }
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];

            if ($image['error'] === UPLOAD_ERR_OK && in_array($image['type'], $allowedTypes)) {
                $currentImage = $this->historyService->getCurrentImagePathTourStartingPoint($id, $columnName);
                $tmpName = $image['tmp_name'];
                $name = uniqid() . '-' . basename($image['name']);
                $destination = $uploadsDir . '/' . $name;

                if (move_uploaded_file($tmpName, $destination)) {
                    $imageUrl = "/assets/images/history_event/starting_point/$name";
                    $this->historyService->editImagePathsTourStartingPoint($id, $imageUrl, $columnName);

                    if ($currentImage && $currentImage != $imageUrl) {
                        @unlink($projectRoot . '/app/public/' . $currentImage);
                    }
                    echo json_encode(['success' => true, 'imageUrl' => $imageUrl]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Failed to save the file.']);
                }
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

            if (isset($input['parentPage'], $input['question'], $input['answer'])) {
                $parentPage = $input['parentPage'];
                $question = $input['question'];
                $answer = $input['answer'];

                $this->historyService->addHistoryPracticalInformation($parentPage, $question, $answer);

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