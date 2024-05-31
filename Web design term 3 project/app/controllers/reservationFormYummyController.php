<?php
namespace App\Controllers;

use App\Services\YummyService;
use App\Utilities\ErrorHandlerMethod;
use App\Utilities\SessionManager;
use App\Utilities\HandleDataCheck;

class ReservationFormYummyController
{
    private $yummyService;
    private $sessionManager;

    const IS_ACTIVE = 1; // used to create active reservations

    public function index()
    {
        session_start();
        require __DIR__ . '/../views/yummy_event/reservationForm.php';
    }
    public function __construct()
    {
        $this->yummyService = new YummyService();
        $this->sessionManager = new SessionManager();
    }

    public function handleReservation()
    {
        try {
            session_start();

            ErrorHandlerMethod::serverIsNotPostMethodCheck($this->sessionManager, '/yummyevent', $_SERVER['REQUEST_METHOD']);

            if (isset($_POST['restaurantID'])) {
                $restaurantID = $_POST['restaurantID'];
                if (!is_numeric($restaurantID)) {
                    $this->sessionManager->setError("Invalid restaurant ID.");
                    header('Location: /yummyevent');
                    exit;
                }
            } else {
                $this->sessionManager->setError("Something went wrong. Please try again.");
                header('Location: /yummyevent');
                exit;
            }

            if (isset($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['session'], $_POST['date'], $_POST['numberOfAdults'])) {
                // Extract and sanitize data from the POST request
                $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
                $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                $session = filter_input(INPUT_POST, 'session', FILTER_SANITIZE_NUMBER_INT);
                $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
                $numberOfAdults = filter_input(INPUT_POST, 'numberOfAdults', FILTER_SANITIZE_NUMBER_INT);

                if (isset($_POST['comment'])) {
                    $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
                } else {
                    $comment = ' ';
                }
                if (isset($_POST['phoneNumber'])) {
                    $phoneNumber = filter_input(INPUT_POST, 'phoneNumber', FILTER_SANITIZE_STRING);
                } else {
                    $phoneNumber = ' ';
                }
                if (isset($_POST['numberOfChildren'])) {
                    $numberOfChildren = filter_input(INPUT_POST, 'numberOfChildren', FILTER_SANITIZE_NUMBER_INT);
                } else {
                    $numberOfChildren = 0;
                }

                HandleDataCheck::checkText([$firstName, $lastName, $email, $date], $this->sessionManager, "/ReservationFormYummy?restaurantID=$restaurantID");
                HandleDataCheck::checkNumber($numberOfAdults, $this->sessionManager, "/ReservationFormYummy?restaurantID=$restaurantID");

                $toBeOccpied = (int) $numberOfAdults + (int) $numberOfChildren;
                if (!$this->checkAvailability($restaurantID, $toBeOccpied)) {
                    $this->sessionManager->setError("No available seats for this reservation.");
                    header("Location: /ReservationFormYummy?restaurantID=$restaurantID");
                    exit;
                }

                $this->yummyService->addReservation($restaurantID, $firstName, $lastName, $email, $phoneNumber, $session, $date, $numberOfAdults, $numberOfChildren, $comment, self::IS_ACTIVE);
                $this->sessionManager->setSuccess("Reservation has been successfully added.");
                header("Location: /ReservationFormYummy?restaurantID=$restaurantID");
                exit;

            } else {
                $this->sessionManager->setError("Error in the form fields. Please fill all the fields.");
                header("Location: /ReservationFormYummy?restaurantID=$restaurantID");
                exit;
            }

        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorController($e, $this->sessionManager, '/');
        }
    }

    private function checkAvailability($restaurantID, $toBeOccpied): bool
    {
        try {
            $reservations = $this->yummyService->getReservationsByRestaurantID($restaurantID);
            $resturant = $this->yummyService->getRestaurantByID($restaurantID);

            $occupiedSeats = 0;

            foreach ($reservations as $reservation) {
                if ($reservation->isActive == self::IS_ACTIVE) {
                    $occupiedSeats += $reservation->numberOfAdults + $reservation->numberOfChildren;
                }
            }

            if ($occupiedSeats + $toBeOccpied <= $resturant->numberOfSeats) {
                return true;
            }
            return false;


        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorController($e, $this->sessionManager, '/');
        }
        return false;

    }


}