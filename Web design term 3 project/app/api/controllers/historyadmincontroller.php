<?php

namespace App\Api\Controllers;

use App\Services\HistoryService;
use App\Models\History_event\HistoryPracticalInformation;

class HistoryAdminController
{
    private $historyService;

    public function __construct()
    {
        $this->historyService = new HistoryService();
    }

    public function updateHistoryPracticalInformation()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = json_decode(file_get_contents('php://input'), true);

            if (isset($input['informationID'], $input['question'], $input['answer'])) {
                $id = $input['informationID'];
                $question = $input['question'];
                $answer = $input['answer'];

                $this->historyService->editHistoryPracticalInformation($id, $question, $answer);

                echo json_encode(['message' => 'Information updated successfully']);
            } else {
                http_response_code(400); // Bad Request
                echo json_encode(['message' => 'Missing required fields']);
            }
        }
    }

    public function createHistoryPracticalInformation()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = json_decode(file_get_contents('php://input'), true);

            if (isset($input['parentPage'], $input['question'], $input['answer'])) {
                $parentPage = $input['parentPage'];
                $question = $input['question'];
                $answer = $input['answer'];

                $this->historyService->addHistoryPracticalInformation($parentPage, $question, $answer);

                echo json_encode(['message' => 'New information added successfully']);
            } else {

                http_response_code(400); // Bad Request
                echo json_encode(['message' => 'Missing required fields']);
            }
        }
    }

    public function deleteHistoryPracticalInformation()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = json_decode(file_get_contents('php://input'), true);

            if (isset($input['informationID'])) {
                $id = $input['informationID'];

                $this->historyService->deleteHistoryPracticalInformation($id);

                echo json_encode(['message' => 'Information deleted successfully']);
            } else {

                http_response_code(400); // Bad Request
                echo json_encode(['message' => 'Missing required field: informationID']);
            }
        }
    }


}