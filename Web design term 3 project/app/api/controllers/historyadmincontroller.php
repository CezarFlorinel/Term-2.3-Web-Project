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

    public function deleteImageFromCarousel()
    {
        // Retrieve and decode the JSON from the request body
        $data = json_decode(file_get_contents('php://input'), true);

        // Now check if the necessary data is present
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($data['id'], $data['imagePath'])) {
            $id = $data['id'];
            $imageToDelete = $data['imagePath']; // Assuming this is a relative path from the project root.

            // Remove the image file from the folder
            $projectRoot = realpath(__DIR__ . '/../../..');
            $fullImagePath = $projectRoot . '/app/public/assets/images/' . $imageToDelete;
            $pathForSQLdelete = 'assets/images/' . $imageToDelete;

            // Check if file exists before trying to delete
            if (file_exists($fullImagePath)) {
                if (!unlink($fullImagePath)) {
                    // File exists but couldn't be deleted
                    echo json_encode(['success' => false, 'error' => 'Failed to delete the file from the server.']);
                    return;  // Stop execution if we couldn't delete the file
                }
            } else {
                // File does not exist, might already be deleted or wrong path provided
                echo json_encode(['success' => false, 'error' => 'File does not exist on the server.']);
                return;
            }


            $resultString = $this->remakeImageCarouselStringForDeletion($pathForSQLdelete);


            // Now proceed to remove the image path from the database
            $this->historyService->editImagePathHistoryDelete($id, $resultString);

            // Return a success message
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

    public function uploadNewImageCarousel()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'], $_POST['id'])) {
            $image = $_FILES['image'];
            $id = $_POST['id'];

            $projectRoot = realpath(__DIR__ . '/../../..');
            $uploadsDir = $projectRoot . '/app/public/assets/images/history_event/top_part';
            if (!file_exists($uploadsDir)) {
                mkdir($uploadsDir, 0777, true);
            }
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];

            if ($image['error'] === UPLOAD_ERR_OK && in_array($image['type'], $allowedTypes)) {
                $uniqueSuffix = time() . '-' . rand(); // Ensuring unique filename
                $newFileName = $uniqueSuffix . '-' . basename($image['name']);
                $destination = $uploadsDir . '/' . $newFileName;

                if (move_uploaded_file($image['tmp_name'], $destination)) {
                    // Construct the new image URL path
                    $imageUrl = "assets/images/history_event/top_part/$newFileName";

                    // Here, implement the method to update the image path in your database
                    // This could look something like this:
                    $this->historyService->editImagePathHistoryTopPart($id, $imageUrl);

                    echo json_encode(['success' => true, 'imageUrl' => '/' . $imageUrl]);
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
                http_response_code(400); // Bad Request
                echo json_encode(['message' => 'Missing required fields']);
            }
        }
    }

    public function updateHistoryToursImages()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'], $_POST['id'])) {
            $image = $_FILES['image'];
            $id = $_POST['id'];

            $projectRoot = realpath(__DIR__ . '/../../..');
            $uploadsDir = $projectRoot . '/app/public/assets/images/history_event/Route';
            if (!file_exists($uploadsDir)) {
                mkdir($uploadsDir, 0777, true);
            }
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];

            if ($image['error'] === UPLOAD_ERR_OK && in_array($image['type'], $allowedTypes)) {
                $currentImage = $this->historyService->getCurrentImagePathRoute($id);
                $tmpName = $image['tmp_name'];
                $name = uniqid() . '-' . basename($image['name']);
                $destination = $uploadsDir . '/' . $name;

                if (move_uploaded_file($tmpName, $destination)) {
                    $imageUrl = "/assets/images/history_event/Route/$name";
                    $this->historyService->editImagePathHistoryRoute($id, $imageUrl);

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
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'], $_POST['id'], $_POST['columnName'])) {
            $image = $_FILES['image'];
            $id = $_POST['id'];
            $columnName = $_POST['columnName']; // $columnName will be either 'MainImagePath' or 'SecondaryImagePath'

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