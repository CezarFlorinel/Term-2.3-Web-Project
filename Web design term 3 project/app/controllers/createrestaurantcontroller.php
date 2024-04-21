<?php
namespace App\Controllers;

use App\Services\YummyService;
use App\Utilities\ImageEditor;
use App\Utilities\ErrorHandlerMethod;
use App\Utilities\SessionManager;

class CreateRestaurantController
{
    private $yummyService;
    private $sessionManager;

    public function index()
    {
        require __DIR__ . '/../views/administrator_control_pages/yummy/createRestaurant.php';
    }

    public function __construct()
    {
        $this->yummyService = new YummyService();
        $this->sessionManager = new SessionManager();
    }

    public function createRestaurant()
    {
        try {
            session_start();
            ErrorHandlerMethod::serverIsNotPostMethodCheck($this->sessionManager, '/createRestaurant', $_SERVER['REQUEST_METHOD']);

            if (isset($_POST['cuisineType'], $_POST['numberOfStars'], $_POST['name'], $_POST['location'], $_POST['description'], $_POST['descriptionLeft'], $_POST['descriptionRight'], $_POST['numberOfSeats'], $_FILES['imageTop'], $_FILES['imageLocation'], $_FILES['imageChef'])) {
                $name = $_POST['name'];
                $location = $_POST['location'];
                $description = $_POST['description'];
                $descriptionLeft = $_POST['descriptionLeft'];
                $descriptionRight = $_POST['descriptionRight'];
                $numberOfSeats = filter_var($_POST['numberOfSeats'], FILTER_VALIDATE_INT);
                $numberOfStars = filter_var($_POST['numberOfStars'], FILTER_VALIDATE_INT);
                $imageTop = $_FILES['imageTop'];
                $imageLocation = $_FILES['imageLocation'];
                $imageChef = $_FILES['imageChef'];
                $cuisineType = $_POST['cuisineType'];


                $imageUrlTop = $this->storeImage($imageTop);
                $imageUrlLocation = $this->storeImage($imageLocation);
                $imageUrlChef = $this->storeImage($imageChef);
                if ($imageUrlTop === '' || $imageUrlLocation === '' || $imageUrlChef === '') {
                    $this->sessionManager->setError("Error in the image upload");
                    return;
                }

                $this->yummyService->createNewRestaurant($name, $location, $description, $descriptionLeft, $descriptionRight, $numberOfSeats, $numberOfStars, $cuisineType, $imageUrlTop, $imageUrlLocation, $imageUrlChef);
                header('Location: /yummyHomeAdmin');

            } else {
                $this->sessionManager->setError("Error in the form fields. Please fill all the fields.");
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorController($e, $this->sessionManager, '/createRestaurant');
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