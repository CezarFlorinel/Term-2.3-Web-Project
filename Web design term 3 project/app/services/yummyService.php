<?php
namespace App\Services;

use App\Repositories\YummyRepository;

class YummyService
{
    private $yummyRepository;

    public function __construct()
    {
        $this->yummyRepository = new YummyRepository();
    }

    //-------------------- GET METHODS --------------------------------------------------------
    //-------------------- Home Part ------------------
    public function getHomepageDataRestaurant()
    {
        return $this->yummyRepository->getHomepageDataRestaurant();
    }

    public function getCurrentHomepageDataRestaurantImagePath($id, $columnName)
    {
        return $this->yummyRepository->getCurrentHomepageDataRestaurantImagePath($id, $columnName);
    }

    //-------------------- EDIT METHODS --------------------------------------------------------
    //-------------------- Home Part ------------------
    public function editHomepageDataRestaurant($id, $subheader, $description)
    {
        $this->yummyRepository->editHomepageDataRestaurant($id, $subheader, $description);
    }

    public function editImagePathHomepageDataRestaurant($id, $columnName, $imageUrl)
    {
        $this->yummyRepository->editImagePathHomepageDataRestaurant($id, $columnName, $imageUrl);
    }


}
