<?php

namespace App\Api\Controllers;

use App\Services\DanceService;
use App\Utilities\ImageEditor;
use App\Utilities\ErrorHandlerMethod;
use Exception;

class DanceHomeAdminController
{
    private $danceService;

    public function __construct()
    {
        $this->historyService = new DanceService();
        ImageEditor::initialize();
    }
}