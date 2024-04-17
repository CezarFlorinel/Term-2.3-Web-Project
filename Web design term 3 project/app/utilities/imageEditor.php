<?php

namespace App\Utilities;

class ImageEditor
{
    private static $projectRoot;
    private static $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
    private static $substringToRemove = "/app/public/";
    private const ImageSizeLimit = 10000000; // 10MB

    public static function initialize() // initialize this before use
    {
        self::$projectRoot = realpath(__DIR__ . '/../..');
    }
    public static function saveImage(string $directoryPath, $image): ?string
    {
        $uploadsDir = self::$projectRoot . $directoryPath;

        if (!file_exists($uploadsDir)) {
            mkdir($uploadsDir, 0777, true);
        }
        if ($image['error'] === UPLOAD_ERR_OK && in_array($image['type'], self::$allowedTypes) && $image['size'] <= self::ImageSizeLimit) {
            $uniqueSuffix = time() . '-' . rand(); // Ensuring unique filename
            $newFileName = $uniqueSuffix . '-' . basename($image['name']);
            $destination = $uploadsDir . '/' . $newFileName;

            if (move_uploaded_file($image['tmp_name'], $destination)) {
                $updatedDirectoryPath = str_replace(self::$substringToRemove, "", $directoryPath);
                $imageUrl = $updatedDirectoryPath . '/' . $newFileName;
                return $imageUrl;
            }
        }
        return null;
    }

    public static function deleteImage(string $imagePath)
    {
        $imageFullPath = self::$projectRoot . self::$substringToRemove . $imagePath;
        if (!file_exists($imageFullPath) || !unlink($imageFullPath)) {
            echo json_encode(['success' => false, 'error' => 'Failed to delete the file from the server. It may not exist.']);
            return;
        }
    }

}