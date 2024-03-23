<?php
namespace App\Controllers;

use App\Services\YummyService;

class CreateRestaurantController
{
    private $yummyService;

    public function index()
    {
        require __DIR__ . '/../views/administrator_control_pages/yummy/createRestaurant.php';
    }

    public function __construct()
    {
        $this->yummyService = new YummyService();
    }

    public function createRestaurant()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset ($_POST['cuisineType'], $_POST['numberOfStars'], $_POST['name'], $_POST['location'], $_POST['description'], $_POST['descriptionLeft'], $_POST['descriptionRight'], $_POST['numberOfSeats'], $_FILES['imageTop'], $_FILES['imageLocation'], $_FILES['imageChef'])) {
                $name = $_POST['name'];
                $location = $_POST['location'];
                $description = $_POST['description'];
                $descriptionLeft = $_POST['descriptionLeft'];
                $descriptionRight = $_POST['descriptionRight'];
                $numberOfSeats = $_POST['numberOfSeats'];
                $numberOfStars = $_POST['numberOfStars'];
                $imageTop = $_FILES['imageTop'];
                $imageLocation = $_FILES['imageLocation'];
                $imageChef = $_FILES['imageChef'];
                $cuisineType = $_POST['cuisineType'];


                $imageUrlTop = $this->storeImage($imageTop);
                $imageUrlLocation = $this->storeImage($imageLocation);
                $imageUrlChef = $this->storeImage($imageChef);
                if ($imageUrlTop === '' || $imageUrlLocation === '' || $imageUrlChef === '') {
                    echo "Error in the image upload";
                    return;
                }


                $this->yummyService->createNewRestaurant($name, $location, $description, $descriptionLeft, $descriptionRight, $numberOfSeats, $numberOfStars, $cuisineType, $imageUrlTop, $imageUrlLocation, $imageUrlChef);
                header('Location: /createRestaurant');

            } else {
                echo "Error in the form fields. Please fill all the fields.";
            }
        } else {
            echo "Error, Invalid Request"; // error handling
        }

    }

    private function storeImage($image): string
    {
        $projectRoot = realpath(__DIR__ . '/../../..');
        $uploadsDir = $projectRoot . '/app/public/assets/images/yummy_event/individual_resturant';

        if (!file_exists($uploadsDir)) {
            mkdir($uploadsDir, 0777, true);
        }
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];

        if ($image['error'] === UPLOAD_ERR_OK && in_array($image['type'], $allowedTypes)) {
            $tmpName = $image['tmp_name'];
            $name = uniqid() . '-' . basename($image['name']);
            $destination = $uploadsDir . '/' . $name;

            if (move_uploaded_file($tmpName, $destination)) {
                $imageUrl = "assets/images/yummy_event/individual_resturant/$name";
                return $imageUrl;
            } else {
                return '';
            }
        }
        return '';
    }

}