<?php
namespace App\Controllers;

require __DIR__ . '/../../app/vendor/autoload.php';

class PaymentSuccessController
{
    private $paymentMethod = null;

    public function index()
    {
        require __DIR__ . '/../views/payment/payment_success.php';
        session_start();
        $this->getPaymentMethod();
    }

    private function getPaymentMethod()
    {
        require_once '../config/secrets.php';
        \Stripe\Stripe::setApiKey($stripeSecretKey);
        // Assuming you're in the handler for '/paymentSuccess'
        $sessionId = $_GET['session_id'] ?? null;
        if ($sessionId) {
            try {
                $session = \Stripe\Checkout\Session::retrieve($sessionId);
                $paymentIntentId = $session->payment_intent;

                $paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);
                $paymentMethodId = $paymentIntent->payment_method;

                $paymentMethod = \Stripe\PaymentMethod::retrieve($paymentMethodId);


            } catch (\Exception $e) {
                // Handle error
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Session ID is missing.";
        }
    }

    private function addInvoiceInDB()
    {
        $customerData = $_SESSION['customerData'];
        $quantity = $_SESSION['itemsTotal'];
        $total = $_SESSION['totalPrice'];
        $totalVAT = $_SESSION['totalVAT'];
        date_default_timezone_set('Europe/Berlin');


    }
    private function generatePDFInvoice()
    {

    }

    private function sendEmail()
    {

    }

    private function makeTickets()
    {

    }
}