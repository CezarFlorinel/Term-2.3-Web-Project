<?php
namespace App\Controllers;

public function homepage() {
    $restaurantService = new RestaurantService(new RestaurantRepository());
    $restaurants = $restaurantService->getAllRestaurants();
    require_once 'views/yummy/homepage.php';
}

