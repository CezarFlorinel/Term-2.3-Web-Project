<?php
namespace App\Controllers;

require __DIR__ . '/../../app/vendor/autoload.php';

class PaymentController
{
    private $customerData;

    public function index()
    {
        require __DIR__ . '/../views/payment/index.php';
    }

    public function storeCustomerData()
    {
        session_start();

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

            $YOUR_DOMAIN = 'http://localhost';

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

    // public function handleWebhook()
    // {
    //     // Retrieve the request's body and parse it as JSON
    //     $payload = @file_get_contents('php://input');
    //     $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];

    //     $endpoint_secret = 'your_stripe_endpoint_secret'; // Replace this with your endpoint's secret

    //     try {
    //         // You can find your endpoint's secret in your webhook settings in the Stripe dashboard
    //         $event = \Stripe\Webhook::constructEvent(
    //             $payload,
    //             $sig_header,
    //             $endpoint_secret
    //         );

    //         // Handle the event
    //         switch ($event->type) {
    //             case 'payment_intent.succeeded':
    //                 $paymentIntent = $event->data->object; // contains a StripePaymentIntent
    //                 // Handle successful payment here
    //                 break;
    //             case 'checkout.session.completed':
    //                 $session = $event->data->object; // contains a StripeCheckoutSession
    //                 // Handle checkout session completion here
    //                 break;
    //             // Add more case statements to handle other event types
    //             default:
    //                 echo 'Received unknown event type ' . $event->type;
    //         }

    //         http_response_code(200); // PHP 5.4 or greater
    //         echo json_encode(['status' => 'success']);
    //     } catch (\UnexpectedValueException $e) {
    //         // Invalid payload
    //         http_response_code(400); // PHP 5.4 or greater
    //         echo 'Webhook error while parsing basic request.';
    //         exit();
    //     } catch (\Stripe\Exception\SignatureVerificationException $e) {
    //         // Invalid signature
    //         http_response_code(400); // PHP 5.4 or greater
    //         echo 'Webhook error while validating signature.';
    //         exit();
    //     }
    // }
}