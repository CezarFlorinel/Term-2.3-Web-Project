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
            // Assuming you receive JSON payload, decode it
            $input = json_decode(file_get_contents('php://input'), true);

            // Validate input data as necessary
            if (isset($input['informationID'], $input['question'], $input['answer'])) {
                // Extract data from the received JSON
                $id = $input['informationID'];
                $question = $input['question'];
                $answer = $input['answer'];

                // Save updated information using your service layer
                // Adjust this part if your service layer expects a different format or method
                $this->historyService->editHistoryPracticalInformation($id, $question, $answer);

                // Respond back with success message
                echo json_encode(['message' => 'Information updated successfully']);
            } else {
                // Respond back with error message
                http_response_code(400); // Bad Request
                echo json_encode(['message' => 'Missing required fields']);
            }
        }
    }

    public function createHistoryPracticalInformation()
    {

    }
    public function deleteHistoryPracticalInformation()
    {

    }


}