<?php
require_once __DIR__ . '/../models/Question.php';
require_once __DIR__ . '/../services/USSDService.php';

class QuestionController {
    private $db;
    private $questionModel;
    private $ussdService;

    public function __construct($db) {
        $this->db = $db;
        $this->questionModel = new Question($db);
        $this->ussdService = new USSDService($this->questionModel);
    }

    public function handleUSSDRequest() {
        $sessionId = $_POST['sessionId'] ?? '';
        $phoneNumber = $_POST['phoneNumber'] ?? '';
        $text = $_POST['text'] ?? '';

        $response = $this->ussdService->handleRequest($sessionId, $phoneNumber, $text);
        header('Content-type: text/plain');
        echo $response;
    }
} 