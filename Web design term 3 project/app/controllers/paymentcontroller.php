<?php
namespace App\Controllers;

require __DIR__ . '/../../app/vendor/autoload.php';

class PaymentController
{

    public function index()
    {
        require __DIR__ . '/../views/payment/index.php';
    }
    public function redirectToCheckout()
    {
        try {
            require_once '../config/secrets.php';
            \Stripe\Stripe::setApiKey($stripeSecretKey);
            header('Content-Type: application/json');

            $YOUR_DOMAIN = 'http://localhost';

            $checkout_session = \Stripe\Checkout\Session::create([
                'line_items' => [
                    [
                        # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
                        'price' => 'price_1Oz34wLVtBYjQ2Miu1UQkdDD',
                        'quantity' => 1,
                    ]
                ],
                'mode' => 'payment',
                'success_url' => $YOUR_DOMAIN . '/danceevent',
                'cancel_url' => $YOUR_DOMAIN . '/yummyevent',
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