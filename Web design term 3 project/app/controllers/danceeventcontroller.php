<?php
namespace App\Controllers;

use App\Utilities\ErrorHandlerMethod;
use App\Utilities\SessionManager;
use App\Services\PaymentService;

class DanceEventController
{

    private $sessionManager;
    private $paymentService;

    const DEFAULT_PASS_QUANTITY = 1;
    const DEFAULT_TYPE = "DanceFestival";

    public function index()
    {
        require __DIR__ . '/../views/dance_event/index.php';
    }

    public function __construct()
    {
        $this->sessionManager = new SessionManager();
        $this->paymentService = new PaymentService();
    }

    public function addPassToCart()
    {
        try {
            session_start();
            ErrorHandlerMethod::serverIsNotPostMethodCheck($this->sessionManager, '/danceEvent', $_SERVER['REQUEST_METHOD']);

            if (isset($_POST['passID'], $_POST['orderID'])) {
                $passID = filter_var($_POST['passID'], FILTER_VALIDATE_INT);
                $orderID = filter_var($_POST['orderID'], FILTER_VALIDATE_INT);

                $this->paymentService->createNewOrderItem(self::DEFAULT_PASS_QUANTITY, self::DEFAULT_TYPE, $orderID, $passID);

                $this->sessionManager->setSuccess("Pass added to cart.");
                header('Location: /personalProgramListView');
                exit;
            } else {
                $this->sessionManager->setError("Please select a pass to add to the cart.");
                header('Location: /danceEvent');
                exit;
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorController($e, $this->sessionManager, '/danceEvent');
        }

    }


}