<?php

namespace App\Api\Controllers;

use App\Services\YummyService;
use App\Utilities\ImageEditor;
use App\Utilities\ErrorHandlerMethod;

class PersonalProgramListViewController
{
    private $yummyService;

    public function __construct()
    {
        $this->yummyService = new YummyService();
    }
}