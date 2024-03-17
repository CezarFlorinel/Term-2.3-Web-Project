<?php

namespace App\Api\Controllers;

use App\Services\YummyService;

class YummyHomeAdminController
{
    private $yummyService;

    public function __construct()
    {
        $this->yummyService = new YummyService();
    }
}