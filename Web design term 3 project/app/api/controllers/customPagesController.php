<?php

namespace App\Api\Controllers;

use App\Services\CustomPageService;
use App\Utilities\ImageEditor;
use App\Utilities\ErrorHandlerMethod;
use Exception;

class CustomPagesController
{
    private $service;

    public function __construct()
    {
        $this->service = new CustomPageService();
        ImageEditor::initialize();
    }
}