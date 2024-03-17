<?php

namespace App\Api\Controllers;

use App\Services\YummyService;

class RestaurantIndividualAdminController
{
    private $yummyService;

    public function __construct()
    {
        $this->yummyService = new YummyService();
    }

    public function updateRestaurantInformation()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = json_decode(file_get_contents('php://input'), true);

            if (isset ($input['restaurantID'], $input['name'], $input['location'], $input['numberOfSeats'], $input['descriptionTopPart'], $input['descriptionSideOne'], $input['descriptionSideTwo'], $input['rating'])) {
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

    public function updateHomePageImages()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset ($_FILES['image'], $_POST['id'], $_POST['columnName'])) {
            $image = $_FILES['image'];
            $id = $_POST['id'];
            $columnName = $_POST['columnName'];

            $projectRoot = realpath(__DIR__ . '/../../..');
            $uploadsDir = $projectRoot . '/app/public/assets/images/yummy_event/home_page_top';
            if (!file_exists($uploadsDir)) {
                mkdir($uploadsDir, 0777, true);
            }
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];

            if ($image['error'] === UPLOAD_ERR_OK && in_array($image['type'], $allowedTypes)) {
                $currentImage = $this->yummyService->getCurrentHomepageDataRestaurantImagePath($id, $columnName);
                $tmpName = $image['tmp_name'];
                $name = uniqid() . '-' . basename($image['name']);
                $destination = $uploadsDir . '/' . $name;

                if (move_uploaded_file($tmpName, $destination)) {
                    $imageUrl = "assets/images/yummy_event/home_page_top/$name";
                    $this->yummyService->editImagePathHomepageDataRestaurant($id, $columnName, $imageUrl);

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


}