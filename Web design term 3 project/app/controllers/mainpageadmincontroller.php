<?php
namespace App\Controllers;

use App\Services\CustomPageService;
use App\Utilities\HandleDataCheck;
use App\Utilities\SessionManager;
use App\Utilities\ErrorHandlerMethod;
use App\Utilities\ImageEditor;
use Exception;

class MainPageAdminController
{
    private $customPageService;
    private $sessionManager;
    public function index()
    {
        require __DIR__ . '/../views/administrator_control_pages/main_page/index.php';
    }

    public function __construct()
    {
        $this->customPageService = new CustomPageService();
        $this->sessionManager = new SessionManager();
        ImageEditor::initialize();
        session_start();
    }

    public function createCustomPage()
    {
        try {
            ErrorHandlerMethod::serverIsNotPostMethodCheck($this->sessionManager, '/MainPageAdmin', $_SERVER['REQUEST_METHOD']);

            if (isset($_POST['title'])) {
                $title = $_POST['title'];
                HandleDataCheck::checkText($title, $this->sessionManager, '/MainPageAdmin');
                $this->customPageService->addCustomPage(" ", $title); //content is empty for now
                header('Location: /MainPageAdmin');
            } else {
                $this->sessionManager->setError('Please fill in all the fields');
                header('Location: /MainPageAdmin');
            }
        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorController($e, $this->sessionManager, '/MainPageAdmin');
            exit;

        }
    }

    public function deleteCustomPage()
    {
        try {
            if (!isset($_GET['id'])) {
                $this->sessionManager->setError('Please provide a valid ID');
                header('Location: /MainPageAdmin');
                exit;
            }

            $id = $_GET['id'];

            $imagePaths = $this->customPageService->getCustomPageImages($id);
            foreach ($imagePaths as $imagePath) {
                ImageEditor::deleteImage($imagePath->imagePath);
            }

            $this->customPageService->deleteCustomPage($id);

            $this->sessionManager->setSuccess('Custom page deleted successfully');
            header('Location: /MainPageAdmin');

        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorController($e, $this->sessionManager, '/MainPageAdmin');
            exit;

        }
    }
}