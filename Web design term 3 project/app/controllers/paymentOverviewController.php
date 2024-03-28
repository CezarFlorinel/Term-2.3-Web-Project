<?php
namespace App\Controllers;


class PaymentOverviewController
{
    public function index()
    {
        require __DIR__ . '/../views/payment/payment_overview.php';
    }
}