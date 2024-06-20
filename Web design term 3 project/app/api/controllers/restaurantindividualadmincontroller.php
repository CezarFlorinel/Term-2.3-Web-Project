<?php

namespace App\Api\Controllers;

use App\Services\YummyService;
use App\Utilities\ImageEditor;
use App\Utilities\ErrorHandlerMethod;
use App\Utilities\HandleDataCheck;

class RestaurantIndividualAdminController
{
    private $yummyService;

    public function __construct()
    {
        $this->yummyService = new YummyService();
        ImageEditor::initialize();
    }

    public function deleteRestaurant()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($_SERVER["REQUEST_METHOD"] == "DELETE" && isset($data['id'])) {
                $id = filter_var($data['id'], FILTER_VALIDATE_INT);

                $restaurant = $this->yummyService->getRestaurantById($id);
                $galleryImages = $this->yummyService->getRestaurantImagePathGallery($id);
                $otherImages2 = [];
                foreach ($galleryImages as $image) {
                    $otherImages2[] = ['imagePath' => $image->imagePath];
                }
                $otherImages = [
                    ['imagePath' => $restaurant->imagePathHomepage],
                    ['imagePath' => $restaurant->imagePathLocation],
                    ['imagePath' => $restaurant->imagePathChef]
                ];
                $images = array_merge($otherImages2, $otherImages);

                foreach ($images as $image) {
                    ImageEditor::deleteImage($image['imagePath']);
                }

                $this->yummyService->deleteRestaurant($id);
                echo json_encode(['success' => true, 'message' => 'Restaurant deleted successfully']);
            } else {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Missing ID.']);
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }

    public function updateRestaurantInformation()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['restaurantID'], $input['name'], $input['location'], $input['numberOfSeats'], $input['descriptionTopPart'], $input['descriptionSideOne'], $input['descriptionSideTwo'], $input['rating'])) {
                    $id = filter_var($input['restaurantID'], FILTER_VALIDATE_INT);
                    $name = HandleDataCheck::filterEmptyStringAPI($input['name']);
                    $location = HandleDataCheck::filterEmptyStringAPI($input['location']);
                    $numberOfSeats = filter_var($input['numberOfSeats'], FILTER_VALIDATE_INT);
                    $descriptionTopPart = HandleDataCheck::filterEmptyStringAPI($input['descriptionTopPart']);
                    $descriptionSideOne = HandleDataCheck::filterEmptyStringAPI($input['descriptionSideOne']);
                    $descriptionSideTwo = HandleDataCheck::filterEmptyStringAPI($input['descriptionSideTwo']);
                    $rating = filter_var($input['rating'], FILTER_VALIDATE_INT);

                    if ($rating < 0 || $rating > 5) {
                        http_response_code(400);
                        echo json_encode(['success' => false, 'error' => 'Rating must be between 0 and 5']);
                        exit();
                    }

                    $this->yummyService->editRestaurant($id, $name, $location, $numberOfSeats, $rating, $descriptionTopPart, $descriptionSideOne, $descriptionSideTwo);

                    echo json_encode(['success' => true, 'message' => 'Restaurant Information updated successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }

    public function updateRestaurantCuisineTypes()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['restaurantID'], $input['cuisineTypes'])) {
                    $id = filter_var($input['restaurantID'], FILTER_VALIDATE_INT);
                    $cuisineTypes = $input['cuisineTypes'];

                    $this->yummyService->editRestaurantTypeOfCuisine($id, $cuisineTypes);

                    echo json_encode(['success' => true, 'message' => 'Cuisine Types updated successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }

    public function updateRestaurantImages()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'], $_POST['id'], $_POST['columnName'])) {
                $image = $_FILES['image'];
                $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
                $columnName = HandleDataCheck::filterEmptyStringAPI($_POST['columnName']);
                $currentImage = $this->yummyService->getCurrentRestaurantImagePath($id, $columnName);
                $imageUrl = ImageEditor::saveImage('/app/public/assets/images/yummy_event/individual_resturant', $image);

                if ($imageUrl !== null) {
                    $this->yummyService->editRestaurantImagePath($id, $columnName, $imageUrl);
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

    public function updateRestaurantSession()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "PUT") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['id'], $input['availableSeats'], $input['pricesForAdults'], $input['pricesForChildren'], $input['reservationFee'], $input['startTime'], $input['endTime'])) {
                    $id = filter_var($input['id'], FILTER_VALIDATE_INT);
                    $availableSeats = filter_var($input['availableSeats'], FILTER_VALIDATE_INT);
                    $pricesForAdults = filter_var($input['pricesForAdults'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $pricesForChildren = filter_var($input['pricesForChildren'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $reservationFee = filter_var($input['reservationFee'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $startTime = $input['startTime'];
                    $endTime = $input['endTime'];

                    $this->yummyService->editRestaurantSession($id, $availableSeats, $pricesForAdults, $pricesForChildren, $reservationFee, $startTime, $endTime);

                    echo json_encode(['success' => true, 'message' => 'Session updated successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }

    public function deleteRestaurantSession()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['id'])) {
                    $id = filter_var($input['id'], FILTER_VALIDATE_INT);

                    $this->yummyService->deleteRestaurantSession($id);

                    echo json_encode(['success' => true, 'message' => 'Session deleted successfully']);
                } else {
                    http_response_code(400); // Bad Request
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }

    public function addRestaurantSession()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['restaurantID'], $input['availableSeats'], $input['pricesForAdults'], $input['pricesForChildren'], $input['reservationFee'], $input['startTime'], $input['endTime'])) {
                    $restaurantID = filter_var($input['restaurantID'], FILTER_VALIDATE_INT);
                    $availableSeats = filter_var($input['availableSeats'], FILTER_VALIDATE_INT);
                    $pricesForAdults = filter_var($input['pricesForAdults'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $pricesForChildren = filter_var($input['pricesForChildren'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $reservationFee = filter_var($input['reservationFee'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $startTime = $input['startTime'];
                    $endTime = $input['endTime'];

                    $this->yummyService->addRestaurantSession($restaurantID, $availableSeats, $pricesForAdults, $pricesForChildren, $reservationFee, $startTime, $endTime);

                    echo json_encode(['success' => true, 'message' => 'Session added successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }

    public function deleteReview()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['id'])) {
                    $id = filter_var($input['id'], FILTER_VALIDATE_INT);

                    $this->yummyService->deleteRestaurantReview($id);

                    echo json_encode(['success' => true, 'message' => 'Review deleted successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }

    public function addReview()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['restaurantID'], $input['reviewText'], $input['rating'])) {
                    $restaurantID = filter_var($input['restaurantID'], FILTER_VALIDATE_INT);
                    $review = HandleDataCheck::filterEmptyStringAPI($input['reviewText']);
                    $rating = filter_var($input['rating'], FILTER_VALIDATE_INT);

                    $this->yummyService->addRestaurantReview($restaurantID, $rating, $review);

                    echo json_encode(['success' => true, 'message' => 'Review added successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }

    public function deleteImageGallery()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($_SERVER["REQUEST_METHOD"] == "DELETE" && isset($data['id'], $data['imagePath'])) {
                $id = filter_var($data['id'], FILTER_VALIDATE_INT);
                $imageToDelete = $data['imagePath'];
                ImageEditor::deleteImage($imageToDelete);
                $this->yummyService->deleteRestaurantImagePathGallery($id);
                echo json_encode(['success' => true, 'message' => 'Image deleted successfully from both the server and the database.']);

            } else {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Missing ID or imagePath.']);
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }

    public function addRestaurantImagePathGallery()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if (isset($_POST['restaurantID'], $_FILES['image'])) {
                    $restaurantID = filter_var($_POST['restaurantID'], FILTER_VALIDATE_INT);
                    $image = $_FILES['image'];
                    $imageUrl = ImageEditor::saveImage('/app/public/assets/images/yummy_event/restaurant_gallery', $image);

                    if ($imageUrl !== null) {
                        $this->yummyService->addRestaurantImagePathGallery($restaurantID, $imageUrl);
                        $imageId = $this->yummyService->getLastImageGalleryInsertedId();
                        echo json_encode(['success' => true, 'message' => 'Image added successfully', 'imageId' => "$imageId", 'imageUrl' => "$imageUrl"]);

                    } else {
                        http_response_code(400);
                        echo json_encode(['success' => false, 'error' => 'Invalid file or upload error.']);
                    }

                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }

    }

}