<?php

namespace App\Controllers;

use App\Services\YummyService;

class YummyEventController
{
    private $yummyService;

    public function __construct()
    {
        $this->yummyService = new YummyService();
    }

    public function index()
    {     
        require __DIR__ . '/../views/yummy_event/reservation_form.php';
    }

    public function handleReservation()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Extract and sanitize data from the POST request
            $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
            $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $phoneNumber = filter_input(INPUT_POST, 'phoneNumber', FILTER_SANITIZE_STRING);
            $session = filter_input(INPUT_POST, 'session', FILTER_SANITIZE_NUMBER_INT);
            $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
            $numberOfAdults = filter_input(INPUT_POST, 'numberOfAdults', FILTER_SANITIZE_NUMBER_INT);
            $numberOfChildren = filter_input(INPUT_POST, 'numberOfChildren', FILTER_SANITIZE_NUMBER_INT);
            $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);

            // Default restaurant ID and active status 
            $restaurantID = 1; 
            $isActive = 1; 

            try {                
                $this->yummyService->addReservation($restaurantID, $firstName, $lastName, $email, $phoneNumber, $session, $date, $numberOfAdults, $numberOfChildren, $comment, $isActive);
                // Redirect to a success page or another appropriate action
                header('Location: /reservation-success'); // Adjust the redirection URL as needed
            } catch (\Exception $e) {               
                header('Location: /reservation-error'); // Redirect to an error page
            }
            exit;
        } else {          
            echo 'Invalid request method.';
            exit;
        }
    }
}
