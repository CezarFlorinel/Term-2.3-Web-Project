<?php
namespace App\Controllers;

class PaymentController
{
    public function index()
    {
        require __DIR__ . '/../views/payment/Payment_Check_Info.php';
    }
}