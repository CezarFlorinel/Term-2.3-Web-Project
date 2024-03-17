<?php
namespace App\Controllers;

class RestaurantIndividualAdminController
{
    public function index()
    {
        require __DIR__ . '/../views/administrator_control_pages/yummy/editRestaurant.php';
    }
}