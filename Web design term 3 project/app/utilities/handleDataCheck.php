<?php

namespace App\Utilities;

class HandleDataCheck
{
    private static $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
    private static $ImageSizeLimit = 10000000; // 10MB

    public static function checkImageSizeAndType($imageArray, $sessionManager, $location): void
    {
        foreach ($imageArray as $image) {
            if ($image['size'] > self::$ImageSizeLimit) {
                $sessionManager->setError('Image size is too large');
                header('Location: ' . $location);
                exit();
            } else if (!in_array($image['type'], self::$allowedTypes)) {
                $sessionManager->setError('Image type is not allowed');
                header('Location: ' . $location);
                exit();
            }
        }
    }

    public static function checkText($textArray, $sessionManager, $location): void
    {
        foreach ($textArray as $text) {
            if (empty($text)) {
                $sessionManager->setError('Please fill in all the fields');
                header('Location: ' . $location);
                exit();
            }
        }
    }

    public static function checkNumber($number, $sessionManager, $location): void
    {
        if ($number < 0 || $number == null) {
            $sessionManager->setError('Please enter a valid number');
            header('Location: ' . $location);
            exit();
        }
    }

    public static function checkReviewNumber($reviewNumber, $sessionManager, $location): void
    {
        if ($reviewNumber < 0 || $reviewNumber > 5 || $reviewNumber == null) {
            $sessionManager->setError('Please enter a valid number between 0 and 5');
            header('Location: ' . $location);
            exit();
        }
    }

    public static function filterEmptyStringAPI($value)
    {
        $value = trim($value);
        if ($value === '') {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'The string is empty']);
            exit();
        }
        return $value;
    }

}