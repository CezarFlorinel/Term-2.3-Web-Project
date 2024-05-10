<?php

namespace App\Api\Controllers;

use App\Services\DanceService;
use App\Utilities\ImageEditor;
use App\Utilities\ErrorHandlerMethod;
use Exception;

class ArtistAdminManagementController
{
    private $danceService;
    const COLUMN_NAME_ARTIST_IMAGE_TOP = 'ImageTop';
    const COLUMN_NAME_ARTIST_IMAGE_LINEUP = 'ImageArtistLineupHome';

    public function __construct()
    {
        $this->danceService = new DanceService();
        ImageEditor::initialize();
    }

    public function updateArtistName()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "PUT") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['name'], $input['id'])) {
                    $name = $input['name'];
                    $id = $input['id'];

                    $this->danceService->updateArtistName($id, $name);

                    echo json_encode(['success' => true, 'message' => 'Artist updated successfully']);
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

    public function updateArtistImage()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'], $_POST['id'], $_POST['columnName'])) {
                $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
                $image = $_FILES['image'];
                $column = $_POST['columnName'];
                $imageURL = ImageEditor::saveImage('/app/public/assets/images/dance_event/artists', $image);
                $artist = $this->danceService->getArtistById($id);

                if ($imageURL !== null) {
                    if ($column == self::COLUMN_NAME_ARTIST_IMAGE_TOP) {
                        $currentImage = $artist->imageTopPath;
                        $this->danceService->updateImageArtist($id, self::COLUMN_NAME_ARTIST_IMAGE_TOP, $imageURL);
                    } else {
                        $currentImage = $artist->imageAristLineupPath;
                        $this->danceService->updateImageArtist($id, self::COLUMN_NAME_ARTIST_IMAGE_LINEUP, $imageURL);
                    }

                    if ($currentImage && $currentImage != $imageURL) {
                        ImageEditor::deleteImage($currentImage);
                    }

                    echo json_encode(['success' => true, 'imageUrl' => $imageURL]);
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
    public function deleteArtist()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['id'])) {
                    $id = filter_var($input['id'], FILTER_VALIDATE_INT);

                    if ($this->deleteAllArtistImages($id) == false) {
                        http_response_code(500);
                        echo json_encode(['success' => false, 'error' => 'Failed to delete artist images']);
                        return;
                    }

                    $this->danceService->deleteArtist($id);

                    echo json_encode(['success' => true, 'message' => 'Artist deleted successfully']);
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
    public function addSpotifyLink()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $input = json_decode(file_get_contents('php://input'), true);
                if (isset($input['artistID'], $input['spotifyLink'])) {
                    $artistID = filter_var($input['artistID'], FILTER_VALIDATE_INT);
                    $spotifyLink = $input['spotifyLink'];

                    $this->danceService->addArtistSpotifyLink($spotifyLink, $artistID);
                    echo json_encode(['success' => true, 'message' => 'Spotify Link added successfully']);

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
    public function deleteSpotifyLink()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['id'])) {
                    $id = filter_var($input['id'], FILTER_VALIDATE_INT);

                    $this->danceService->deleteArtistSpotifyLinks($id);

                    echo json_encode(['success' => true, 'message' => 'Spotify Link deleted successfully']);
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
    public function addCareerHighlight()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['artistID'], $_POST['titleAndYearPeriod'], $_POST['text']) && isset($_FILES['image'])) {
                    $artistID = filter_var($_POST['artistID'], FILTER_VALIDATE_INT);
                    $titleAndYearPeriod = $_POST['titleAndYearPeriod'];
                    $text = $_POST['text'];
                    $image = $_FILES['image'];

                    $imageURL = ImageEditor::saveImage('/app/public/assets/images/dance_event/artist_career_highlights', $image);

                    if ($imageURL) {
                        $this->danceService->addCareerHighlights($titleAndYearPeriod, $artistID, $text, $imageURL);
                        echo json_encode(['success' => true, 'message' => 'Career Highlight added successfully.']);
                    } else {
                        http_response_code(400);
                        echo json_encode(['success' => false, 'error' => 'Invalid file or upload error.']);
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields or file']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }
        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }

    }

    public function updateCareerHighlight()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "PUT") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['id'], $input['titleYearPeriod'], $input['text'])) {
                    $id = filter_var($input['id'], FILTER_VALIDATE_INT);
                    $titleYearPeriod = $input['titleYearPeriod'];
                    $text = $input['text'];


                    $this->danceService->updateCareerHighlights($id, $titleYearPeriod, $text);

                    echo json_encode(['success' => true, 'message' => 'Career Highlight updated successfully']);
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

    public function updateCareerHighlightImage()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'], $_POST['id'])) {
                $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
                $image = $_FILES['image'];
                $imageURL = ImageEditor::saveImage('/app/public/assets/images/dance_event/artist_career_highlights', $image);
                $careerHighlight = $this->danceService->getCareerHighlightsById($id);

                if ($imageURL !== null) {
                    $this->danceService->updateCareerHighlightsImage($id, $imageURL);
                    if ($careerHighlight->imagePath && $careerHighlight->imagePath != $imageURL) {
                        ImageEditor::deleteImage($careerHighlight->imagePath);
                    }
                    echo json_encode(['success' => true, 'imageUrl' => $imageURL]);

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
    public function deleteCareerHighlight()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['id'])) {
                    $id = filter_var($input['id'], FILTER_VALIDATE_INT);
                    $careerHighlight = $this->danceService->getCareerHighlightsById($id);

                    if ($careerHighlight->imagePath) {
                        ImageEditor::deleteImage($careerHighlight->imagePath);
                    }

                    $this->danceService->deleteCareerHighlights($id);

                    echo json_encode(['success' => true, 'message' => 'Career Highlight deleted successfully']);
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

    private function deleteAllArtistImages($id)
    {
        try {
            $imagePaths = [];
            $artistCareerHighlights = $this->danceService->getCareerHighlightsByArtistID($id);
            $artist = $this->danceService->getArtistById($id);
            foreach ($artistCareerHighlights as $careerHighlight) {
                $imagePaths[] = $careerHighlight->imagePath;
            }

            $imagePaths[] = $artist->imageTopPath;
            $imagePaths[] = $artist->imageAristLineupPath;
            error_log(print_r("\n all artist iamges nr:" . count($imagePaths), true), 3, __DIR__ . '/../../file_with_errors_logs.log'); // Log the input data

            foreach ($imagePaths as $imagePath) {
                error_log(print_r("\n $imagePath", true), 3, __DIR__ . '/../../file_with_errors_logs.log'); // Log the input data

                if ($imagePath) {
                    ImageEditor::deleteImage($imagePath);
                }
            }

            return true; // Everything went well, return true

        } catch (Exception $e) {
            return false;
        }
    }

}