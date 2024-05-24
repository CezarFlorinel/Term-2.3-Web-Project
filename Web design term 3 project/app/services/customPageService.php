<?php

namespace App\Services;

use App\Repositories\CustomPageRepository;
use App\Models\Custom_Pages\CustomPage;
use App\Models\Custom_Pages\CustomPageImage;

class CustomPageService
{
    private $customPageRepository;

    public function __construct()
    {
        $this->customPageRepository = new CustomPageRepository();
    }

    public function getAllCustomPages(): array
    {
        return $this->customPageRepository->getAllCustomPages();
    }

    public function getCustomPageByID(int $customPageID): CustomPage
    {
        return $this->customPageRepository->getCustomPageByID($customPageID);
    }

    public function addCustomPage(string $content, string $title): void
    {
        $this->customPageRepository->addCustomPage($content, $title);
    }

    public function deleteCustomPage(int $customPageID): void
    {
        $this->customPageRepository->deleteCustomPage($customPageID);
    }

    public function addCustomPageImage(int $customPageID, string $imagePath): void
    {
        $this->customPageRepository->addCustomPageImage($customPageID, $imagePath);
    }

    public function getCustomPageImages(int $customPageID): array
    {
        return $this->customPageRepository->getCustomPageImages($customPageID);
    }

    public function deleteCustomPageImage(int $customPageImageID): void
    {
        $this->customPageRepository->deleteCustomPageImage($customPageImageID);
    }

}