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


}
