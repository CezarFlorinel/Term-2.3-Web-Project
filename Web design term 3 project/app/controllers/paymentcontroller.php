<?php
namespace App\Controllers;

require __DIR__ . '/../../app/vendor/autoload.php';

use App\Utilities\HandleDataCheck;
use App\Utilities\SessionManager;
use App\Utilities\ErrorHandlerMethod;

class PaymentController
{
    private $customerData;
    private $sessionManager;

    public function index()
    {
        require __DIR__ . '/../views/payment/index.php';
    }
    public function __construct()
    {
        $this->sessionManager = new SessionManager();
    }

    public function storeCustomerData()
    {
        try {
            session_start();
            ErrorHandlerMethod::serverIsNotPostMethodCheck($this->sessionManager, '/PaymentOverview', $_SERVER['REQUEST_METHOD']);

            if (isset($_POST['extraAddress'], $_POST['country'], $_POST['name'], $_POST['email'], $_POST['phoneNumber'], $_POST['country'], $_POST['address'], $_POST['city'], $_POST['county'], $_POST['zip'])) {

                $this->customerData = [
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'phoneNumber' => $_POST['phoneNumber'],
                    'country' => $_POST['country'],
                    'address' => $_POST['address'],
                    'extraAddress' => $_POST['extraAddress'],
                    'city' => $_POST['city'],
                    'county' => $_POST['county'],
                    'zip' => $_POST['zip']
                ];
                $_SESSION['customerData'] = $this->customerData;
                header('Location: /PaymentOverview');

            } else {
                echo 'Please fill in all the fields';
            }
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function redirectToCheckout()
    {
        try {
            session_start();
            require_once '../config/secrets.php';
            \Stripe\Stripe::setApiKey($stripeSecretKey);
            header('Content-Type: application/json');

            $quantity = $_SESSION['itemsTotal'];
            $total = $_SESSION['totalPrice'];
            $totalVAT = $_SESSION['totalVAT'];
            $unit_amount = (int) round($total * 100);

            $YOUR_DOMAIN = 'http://localhost';  // change this to your domain

            $checkout_session = \Stripe\Checkout\Session::create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'eur',
                            'product_data' => [
                                'name' => 'Tickets (Quantity: ' . $quantity . ')',
                                'description' => ' VAT: ' . $totalVAT . '€',
                            ],
                            'unit_amount' => (int) $unit_amount,
                        ],
                        'quantity' => 1,

                    ]
                ],
                'mode' => 'payment',
                'success_url' => $YOUR_DOMAIN . '/paymentSuccess?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => $YOUR_DOMAIN . '/paymentFailed',
            ]);

            header("HTTP/1.1 303 See Other");
            header("Location: " . $checkout_session->url);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            echo "Stripe API error: " . $e->getMessage();
            exit;
        } catch (\Exception $e) {
            echo "General error: " . $e->getMessage();
            exit;
        }
    }

}