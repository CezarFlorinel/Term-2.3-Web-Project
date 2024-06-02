<?php

namespace App\Api\Controllers;

use App\Services\HistoryService;
use App\Utilities\ImageEditor;
use App\Utilities\ErrorHandlerMethod;
use App\Services\TicketsService;
use App\Services\PaymentService;
use DateTime;
use Exception;

class HistoryAdminController
{
    private $historyService;
    private $ticketsService;
    private $paymentService;

    public function __construct()
    {
        $this->historyService = new HistoryService();
        $this->ticketsService = new TicketsService();
        $this->paymentService = new PaymentService();
        ImageEditor::initialize();
    }

    public function addHistoryTicketToPersonalProgram()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['tourId'], $input['quantity'], $input['typeOfTicket'], $input['orderID'], $input['language'], $input['date'])) {
                    $tourID = filter_var($input['tourId'], FILTER_VALIDATE_INT);
                    $quantity = filter_var($input['quantity'], FILTER_VALIDATE_INT);
                    $typeOfTicket = $input['typeOfTicket'];
                    $orderID = filter_var($input['orderID'], FILTER_VALIDATE_INT);
                    $language = $input['language'];
                    $date = $input['date'];

                    $tour = $this->historyService->getHistoryTourById($tourID);


                    // Combine date and time correctly
                    $time = explode('.', $tour->startTime)[0]; // Remove the fractional seconds
                    $combinedDateTime = $date . ' ' . $time;

                    $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $combinedDateTime);
                    if (!$dateTime) {
                        throw new Exception("Invalid date or time format");
                    }
                    $formattedDateTime = $dateTime->format('Y-m-d H:i:s');


                    $insertedID = $this->ticketsService->addHistoryTicket($formattedDateTime, $language, $typeOfTicket, $tourID);

                    $this->paymentService->createNewOrderItem($quantity, "HistoryFestival", $orderID, null, null, $insertedID);

                    echo json_encode(['success' => true, 'message' => 'Ticket added to personal program successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            }
        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }

    public function uploadNewImageCarousel()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'], $_POST['id'])) {
                $image = $_FILES['image'];
                $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);

                $imageUrl = ImageEditor::saveImage("/app/public/assets/images/history_event/top_part", $image);

                if ($imageUrl !== null) {
                    $this->historyService->editImagePathHistoryTopPart($id, $imageUrl);
                    echo json_encode(['success' => true, 'imageUrl' => '/' . $imageUrl]);
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

    public function deleteImageFromCarousel()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($_SERVER["REQUEST_METHOD"] == "DELETE" && isset($data['id'], $data['imagePath'])) {
                $id = filter_var($data['id'], FILTER_VALIDATE_INT);
                $imageToDelete = $data['imagePath'];

                $pathForSQLdelete = 'assets/images/' . $imageToDelete;

                ImageEditor::deleteImage($pathForSQLdelete);

                $resultString = $this->remakeImageCarouselStringForDeletion($pathForSQLdelete);

                $this->historyService->editImagePathHistoryDelete($id, $resultString);

                echo json_encode(['success' => true, 'message' => 'Image deleted successfully from both the server and the database.']);

            } else {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Missing ID or imagePath.']);
            }
        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
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
        try {
            if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['informationID'], $input['subheader'], $input['description'])) {
                    $id = filter_var($input['informationID'], FILTER_VALIDATE_INT);
                    $subheader = $input['subheader'];
                    $description = $input['description'];

                    $this->historyService->editHistoryTopPart($id, $subheader, $description);

                    echo json_encode(['success' => true, 'message' => 'Top part updated successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Only PATCH method is supported']);
            }
        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }
    public function updateHistoryToursImages()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'], $_POST['id'])) {
                $image = $_FILES['image'];
                $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
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
    public function updateHistoryRouteInformation()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['informationID'], $input['locationName'], $input['locationDescription'], $input['wheelchairSupport'])) {
                    $id = filter_var($input['informationID'], FILTER_VALIDATE_INT);
                    $locationName = $input['locationName'];
                    $locationDescription = $input['locationDescription'];
                    $wheelchairSupport = filter_var($input['wheelchairSupport'], FILTER_VALIDATE_BOOLEAN);  // MAY CAUSE AN ERROR

                    $this->historyService->editHistoryRoute($id, $locationName, $locationDescription, $wheelchairSupport);

                    echo json_encode(['success' => true, 'message' => 'Route updated successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            }
        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }
    public function updateHistoryTicketPricesInformation()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['informationID'], $input['type'], $input['price'], $input['description'])) {
                    $id = filter_var($input['informationID'], FILTER_VALIDATE_INT);
                    $ticketType = $input['type'];
                    $price = filter_var($input['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $description = $input['description'];

                    $this->historyService->editHistoryTicketPrices($id, $ticketType, $price, $description);

                    echo json_encode(['success' => true, 'message' => 'Ticket price updated successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            }
        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }

    }
    public function updateHistoryTicketPricesImages()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'], $_POST['id'])) {
                $image = $_FILES['image'];
                $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
                $currentImage = $this->historyService->getCurrentImagePathTicketPrices($id);
                $imageUrl = ImageEditor::saveImage('/app/public/assets/images/history_event/tickets_types', $image);

                if ($imageUrl !== null) {
                    $this->historyService->editImagePathHistoryTicketPrices($id, $imageUrl);

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
        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }
    public function updateHistoryTourDeparturesTimetable()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['informationID'], $input['date'])) {
                    $id = filter_var($input['informationID'], FILTER_VALIDATE_INT);
                    $date = $input['date'];

                    $this->historyService->editHistoryTourDeparturesTimetables($id, $date);

                    echo json_encode(['success' => true, 'message' => 'Timetable updated successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            }
        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }

    public function updateHistoryTour()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "PUT") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['informationID'], $input['startTime'], $input['englishTour'], $input['dutchTour'], $input['chineseTour'])) {
                    $id = filter_var($input['informationID'], FILTER_VALIDATE_INT);
                    $startTime = $input['startTime'];
                    $englishTour = filter_var($input['englishTour'], FILTER_VALIDATE_INT);
                    $dutchTour = filter_var($input['dutchTour'], FILTER_VALIDATE_INT);
                    $chineseTour = filter_var($input['chineseTour'], FILTER_VALIDATE_INT);

                    $this->historyService->editHistoryTours($id, $startTime, $englishTour, $dutchTour, $chineseTour);

                    echo json_encode(['success' => true, 'message' => 'Tour updated successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            }
        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }

    }

    public function uploadAndUpdateImageForTourStartingPoint()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'], $_POST['id'], $_POST['columnName'])) {
                $image = $_FILES['image'];
                $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
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

    public function updateHistoryTourStartingPointDescription()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "PUT") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['informationID'], $input['description'])) {
                    $id = filter_var($input['informationID'], FILTER_VALIDATE_INT);
                    $description = $input['description'];

                    $this->historyService->editHistoryTourStartingPoint($id, $description);

                    echo json_encode(['success' => true, 'message' => 'Starting point updated successfully']);
                } else {
                    http_response_code(400); // Bad Request
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }

    public function updateHistoryPracticalInformation()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "PUT") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['informationID'], $input['question'], $input['answer'])) {
                    $id = filter_var($input['informationID'], FILTER_VALIDATE_INT);
                    $question = $input['question'];
                    $answer = $input['answer'];

                    $this->historyService->editHistoryPracticalInformation($id, $question, $answer);

                    echo json_encode(['success' => true, 'message' => 'Information updated successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }

    public function createHistoryPracticalInformation()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['question'], $input['answer'])) {
                    $question = $input['question'];
                    $answer = $input['answer'];

                    $this->historyService->addHistoryPracticalInformation($question, $answer);

                    echo json_encode(['success' => true, 'message' => 'New information added successfully']);
                } else {

                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }

    public function deleteHistoryPracticalInformation()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['informationID'])) {
                    $id = filter_var($input['informationID'], FILTER_VALIDATE_INT);

                    $this->historyService->deleteHistoryPracticalInformation($id);

                    echo json_encode(['success' => true, 'message' => 'Information deleted successfully']);
                } else {

                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required field: informationID']);
                }
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }


}