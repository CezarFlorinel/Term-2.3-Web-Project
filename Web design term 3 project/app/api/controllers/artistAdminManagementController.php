<?php

namespace App\Api\Controllers;

use App\Services\DanceService;
use App\Utilities\ImageEditor;
use App\Utilities\ErrorHandlerMethod;
use Exception;

class ArtitstAdminManagemtController
{
    private $danceService;

    public function __construct()
    {
        $this->danceService = new DanceService();
        ImageEditor::initialize();
    }

    public function updateArtist()
    {

    }
    public function deleteArtist()
    {

    }
    public function addSpotifyLink()
    {

    }
    public function deleteSpotifyLink()
    {

    }
    public function addCareerHighlight()
    {

    }
    public function deleteCareerHighlight()
    {

    }
    public function editCareerHighlight()
    {

    }

}