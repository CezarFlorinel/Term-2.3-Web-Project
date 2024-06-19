<?php

namespace App\Api\Controllers;

use App\Services\CustomPageService;
use App\Utilities\ImageEditor;
use App\Utilities\ErrorHandlerMethod;
use App\Utilities\HandleDataCheck;
use Exception;

class CustomPagesController
{
    private $service;

    public function __construct()
    {
        $this->service = new CustomPageService();
        ImageEditor::initialize();
    }

    public function updateCustomPage()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "PUT") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['id'], $input['content'], $input['title'])) {

                    $id = filter_var($input['id'], FILTER_VALIDATE_INT);
                    $content = HandleDataCheck::filterEmptyStringAPI($input['content']);
                    $title = HandleDataCheck::filterEmptyStringAPI($input['title']);

                    $this->service->updateCustomPage($id, $content, $title);

                    echo json_encode(['success' => true, 'message' => 'Custom page updated successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }
        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }

    }

    public function deleteImageFromCustomPage()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['id'])) {
                    $id = filter_var($input['id'], FILTER_VALIDATE_INT);

                    $imagePath = $this->service->getImagePath($id);

                    if ($imagePath !== null) {

                        ImageEditor::deleteImage($imagePath);
                        $this->service->deleteCustomPageImage($id);

                        echo json_encode(['success' => true, 'message' => 'Image deleted successfully']);
                    } else {
                        http_response_code(400);
                        echo json_encode(['success' => false, 'error' => 'File path not found in database.']);
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }

        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }

    public function addImageToCustomPage()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'], $_POST['customPageId'])) {
                $customPageId = filter_var($_POST['customPageId'], FILTER_VALIDATE_INT);
                $image = $_FILES['image'];
                $imageURL = ImageEditor::saveImage('/app/public/assets/images/custom_pages', $image);

                if ($imageURL !== null) {

                    $imageID = $this->service->addCustomPageImage($customPageId, $imageURL);
                    echo json_encode(['success' => true, 'message' => 'Image uploaded successfully', 'imageUrl' => $imageURL, 'imageId' => $imageID]);

                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Invalid file or upload error.']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'No file uploaded or missing ID.']);
            }

        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }

    }
}