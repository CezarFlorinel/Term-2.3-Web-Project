<?php

namespace App\Repositories;

use App\Models\Custom_Pages\CustomPage;
use App\Models\Custom_Pages\CustomPageImage;

use PDO;


class CustomPageRepository extends Repository
{
    public function getAllCustomPages(): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM CUSTOM_PAGES');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pages = [];
        foreach ($results as $result) {
            $pages[] = new CustomPage(
                $result['CustomPageID'],
                $result['Content'],
                $result['CreatedAt'],
                $result['Title']
            );
        }

        return $pages;
    }

    public function getCustomPageByID(int $customPageID): CustomPage
    {
        $stmt = $this->connection->prepare('SELECT * FROM CUSTOM_PAGES WHERE CustomPageID = :CustomPageID');
        $stmt->bindParam(':CustomPageID', $customPageID);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return new CustomPage(
            $result['CustomPageID'],
            $result['Content'],
            $result['CreatedAt'],
            $result['Title']
        );
    }

    public function addCustomPage(string $content, string $title): void
    {
        $stmt = $this->connection->prepare('INSERT INTO CUSTOM_PAGES (Content, Title) VALUES (:Content, :Title)');
        $stmt->bindParam(':Content', $content);
        $stmt->bindParam(':Title', $title);
        $stmt->execute();
    }

    public function deleteCustomPage(int $customPageID): void
    {
        $stmt = $this->connection->prepare('DELETE FROM CUSTOM_PAGES WHERE CustomPageID = :CustomPageID');
        $stmt->bindParam(':CustomPageID', $customPageID);
        $stmt->execute();
    }

    public function updateCustomPage(int $customPageID, string $content, string $title): void
    {
        $stmt = $this->connection->prepare('UPDATE CUSTOM_PAGES SET Content = :Content, Title = :Title WHERE CustomPageID = :CustomPageID');
        $stmt->bindParam(':Content', $content);
        $stmt->bindParam(':Title', $title);
        $stmt->bindParam(':CustomPageID', $customPageID);
        $stmt->execute();
    }

    public function getCustomPageImages(int $customPageID): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM CUSTOM_PAGES_IMAGES_PATHS WHERE CustomPageID = :CustomPageID');
        $stmt->bindParam(':CustomPageID', $customPageID);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $images = [];
        foreach ($results as $result) {
            $images[] = new CustomPageImage(
                $result['ID'],
                $result['CustomPageID'],
                $result['ImagePath']
            );
        }

        return $images;
    }

    public function addCustomPageImage(int $customPageID, string $imagePath): void
    {
        $stmt = $this->connection->prepare('INSERT INTO CUSTOM_PAGES_IMAGES_PATHS (CustomPageID, ImagePath) VALUES (:CustomPageID, :ImagePath)');
        $stmt->bindParam(':CustomPageID', $customPageID);
        $stmt->bindParam(':ImagePath', $imagePath);
        $stmt->execute();
    }

    public function deleteCustomPageImage(int $ID): void
    {
        $stmt = $this->connection->prepare('DELETE FROM CUSTOM_PAGES_IMAGES_PATHS WHERE ID = :ID');
        $stmt->bindParam(':ID', $ID);
        $stmt->execute();
    }

}