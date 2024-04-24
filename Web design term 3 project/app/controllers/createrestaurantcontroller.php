<?php
namespace App\Controllers;

use App\Services\YummyService;
use App\Utilities\ImageEditor;
use App\Utilities\ErrorHandlerMethod;
use App\Utilities\SessionManager;
use App\Utilities\HandleDataCheck;

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
        ImageEditor::initialize();
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

                HandleDataCheck::checkText([$name, $location, $description, $descriptionLeft, $descriptionRight, $cuisineType], $this->sessionManager, '/createRestaurant');
                HandleDataCheck::checkNumber($numberOfSeats, $this->sessionManager, '/createRestaurant');
                HandleDataCheck::checkReviewNumber($numberOfStars, $this->sessionManager, '/createRestaurant');
                HandleDataCheck::checkImageSizeAndType([$imageTop, $imageLocation, $imageChef], $this->sessionManager, '/createRestaurant');

                $imageUrlTop = ImageEditor::saveImage('/app/public/assets/images/yummy_event/individual_resturant', $imageTop);
                $imageUrlLocation = ImageEditor::saveImage('/app/public/assets/images/yummy_event/individual_resturant', $imageLocation);
                $imageUrlChef = ImageEditor::saveImage('/app/public/assets/images/yummy_event/individual_resturant', $imageChef);

                if ($imageUrlTop == null || $imageUrlLocation == null || $imageUrlChef == null) {
                    $this->sessionManager->setError("Error in the image upload");
                    exit;
                }

                $this->yummyService->createNewRestaurant($name, $location, $description, $descriptionLeft, $descriptionRight, $numberOfSeats, $numberOfStars, $cuisineType, $imageUrlTop, $imageUrlLocation, $imageUrlChef);
                header('Location: /yummyHomeAdmin');

            } else {
                $this->sessionManager->setError("Error in the form fields. Please fill all the fields.");
                header('Location: /createRestaurant');
                exit;
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorController($e, $this->sessionManager, '/createRestaurant');
        }
    }

}