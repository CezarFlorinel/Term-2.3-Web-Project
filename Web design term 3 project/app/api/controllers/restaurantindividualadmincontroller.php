<?php

namespace App\Api\Controllers;

use App\Services\YummyService;
use App\Utilities\ImageEditor;
use App\Utilities\ErrorHandlerMethod;

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
                $id = $data['id'];

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
                    $id = $input['restaurantID'];
                    $name = $input['name'];
                    $location = $input['location'];
                    $numberOfSeats = $input['numberOfSeats'];
                    $descriptionTopPart = $input['descriptionTopPart'];
                    $descriptionSideOne = $input['descriptionSideOne'];
                    $descriptionSideTwo = $input['descriptionSideTwo'];
                    $rating = $input['rating'];

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
                    $id = $input['restaurantID'];
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
                $id = $_POST['id'];
                $columnName = $_POST['columnName'];
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
                    $id = $input['id'];
                    $availableSeats = $input['availableSeats'];
                    $pricesForAdults = $input['pricesForAdults'];
                    $pricesForChildren = $input['pricesForChildren'];
                    $reservationFee = $input['reservationFee'];
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
                    $id = $input['id'];

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
                    $restaurantID = $input['restaurantID'];
                    $availableSeats = $input['availableSeats'];
                    $pricesForAdults = $input['pricesForAdults'];
                    $pricesForChildren = $input['pricesForChildren'];
                    $reservationFee = $input['reservationFee'];
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
                    $id = $input['id'];

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
                    $restaurantID = $input['restaurantID'];
                    $review = $input['reviewText'];
                    $rating = $input['rating'];

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
                $id = $data['id'];
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
                    $restaurantID = $_POST['restaurantID'];
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