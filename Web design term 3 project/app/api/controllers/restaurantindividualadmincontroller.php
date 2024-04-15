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
        $data = json_decode(file_get_contents('php://input'), true);
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($data['id'])) {
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
            echo json_encode(['success' => false, 'error' => 'Missing ID.']);
        }
    }

    public function updateRestaurantInformation()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

                echo json_encode(['message' => 'Restaurant Information updated successfully']);
            } else {
                http_response_code(400); // Bad Request
                echo json_encode(['message' => 'Missing required fields']);
            }
        }
    }

    public function updateRestaurantCuisineTypes()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = json_decode(file_get_contents('php://input'), true);

            if (isset($input['restaurantID'], $input['cuisineTypes'])) {
                $id = $input['restaurantID'];
                $cuisineTypes = $input['cuisineTypes'];

                $this->yummyService->editRestaurantTypeOfCuisine($id, $cuisineTypes);

                echo json_encode(['message' => 'Cuisine Types updated successfully']);
            } else {
                http_response_code(400); // Bad Request
                echo json_encode(['message' => 'Missing required fields']);
            }
        }
    }

    public function updateRestaurantImages()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'], $_POST['id'], $_POST['columnName'])) {
            $image = $_FILES['image'];
            $id = $_POST['id'];
            $columnName = $_POST['columnName'];

            $projectRoot = realpath(__DIR__ . '/../../..');
            $uploadsDir = $projectRoot . '/app/public/assets/images/yummy_event/individual_resturant';
            if (!file_exists($uploadsDir)) {
                mkdir($uploadsDir, 0777, true);
            }
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];

            if ($image['error'] === UPLOAD_ERR_OK && in_array($image['type'], $allowedTypes)) {
                $currentImage = $this->yummyService->getCurrentRestaurantImagePath($id, $columnName);
                $tmpName = $image['tmp_name'];
                $name = uniqid() . '-' . basename($image['name']);
                $destination = $uploadsDir . '/' . $name;

                if (move_uploaded_file($tmpName, $destination)) {
                    $imageUrl = "assets/images/yummy_event/individual_resturant/$name";
                    $this->yummyService->editRestaurantImagePath($id, $columnName, $imageUrl);

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

    public function updateRestaurantSession()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

                echo json_encode(['message' => 'Session updated successfully']);
            } else {
                http_response_code(400); // Bad Request
                echo json_encode(['message' => 'Missing required fields']);
            }
        }
    }

    public function deleteRestaurantSession()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = json_decode(file_get_contents('php://input'), true);

            if (isset($input['id'])) {
                $id = $input['id'];

                $this->yummyService->deleteRestaurantSession($id);

                echo json_encode(['message' => 'Session deleted successfully']);
            } else {
                http_response_code(400); // Bad Request
                echo json_encode(['message' => 'Missing required fields']);
            }
        }
    }

    public function addRestaurantSession()
    {
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

                echo json_encode(['message' => 'Session added successfully']);
            } else {
                http_response_code(400); // Bad Request
                echo json_encode(['message' => 'Missing required fields']);
            }
        }
    }

    public function deleteReview()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = json_decode(file_get_contents('php://input'), true);

            if (isset($input['id'])) {
                $id = $input['id'];

                $this->yummyService->deleteRestaurantReview($id);

                echo json_encode(['message' => 'Review deleted successfully']);
            } else {
                http_response_code(400); // Bad Request
                echo json_encode(['message' => 'Missing required fields']);
            }
        }
    }

    public function addReview()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = json_decode(file_get_contents('php://input'), true);

            if (isset($input['restaurantID'], $input['reviewText'], $input['rating'])) {
                $restaurantID = $input['restaurantID'];
                $review = $input['reviewText'];
                $rating = $input['rating'];

                $this->yummyService->addRestaurantReview($restaurantID, $rating, $review);

                echo json_encode(['message' => 'Review added successfully']);
            } else {
                http_response_code(400); // Bad Request
                echo json_encode(['message' => 'Missing required fields']);
            }
        }
    }

    public function deleteImageGallery()
    {
        // Retrieve and decode the JSON from the request body
        $data = json_decode(file_get_contents('php://input'), true);

        // Now check if the necessary data is present
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($data['id'], $data['imagePath'])) {
            $id = $data['id'];
            $imageToDelete = $data['imagePath'];

            // Remove the image file from the folder
            $projectRoot = realpath(__DIR__ . '/../../..');
            $fullImagePath = $projectRoot . '/app/public/' . $imageToDelete;

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
            $this->yummyService->deleteRestaurantImagePathGallery($id);

            // Return a success message
            echo json_encode(['success' => true, 'message' => 'Image deleted successfully from both the server and the database.']);

        } else {
            echo json_encode(['success' => false, 'error' => 'Missing ID or imagePath.']);
        }
    }

    public function addRestaurantImagePathGallery()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST['restaurantID'], $_FILES['image'])) {
                $restaurantID = $_POST['restaurantID'];
                $image = $_FILES['image'];
                $projectRoot = realpath(__DIR__ . '/../../..');
                $uploadsDir = $projectRoot . '/app/public/assets/images/yummy_event/restaurant_gallery';

                if (!file_exists($uploadsDir)) {
                    mkdir($uploadsDir, 0777, true);
                }
                $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];

                if ($image['error'] === UPLOAD_ERR_OK && in_array($image['type'], $allowedTypes)) {
                    $tmpName = $image['tmp_name'];
                    $name = uniqid() . '-' . basename($image['name']);
                    $destination = $uploadsDir . '/' . $name;

                    if (move_uploaded_file($tmpName, $destination)) {
                        $imageUrl = "assets/images/yummy_event/restaurant_gallery/$name";
                        $this->yummyService->addRestaurantImagePathGallery($restaurantID, $imageUrl);
                        $imageId = $this->yummyService->getLastImageGalleryInsertedId();

                        echo json_encode(['success' => true, 'message' => 'Image added successfully', 'imageId' => "$imageId", 'imageUrl' => "$imageUrl"]);
                    } else {
                        echo json_encode(['success' => false, 'error' => 'Failed to save the file.']);
                    }
                } else {
                    echo json_encode(['success' => false, 'error' => 'Invalid file or upload error.']);
                }

            } else {
                http_response_code(400); // Bad Request
                echo json_encode(['message' => 'Missing required fields']);
            }
        }
    }

}