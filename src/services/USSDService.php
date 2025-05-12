<?php

class USSDService {
    private $questionModel;
    private $session = [];

    public function __construct($questionModel) {
        $this->questionModel = $questionModel;
    }

    public function handleRequest($sessionId, $phoneNumber, $text) {
        $this->session = [
            'sessionId' => $sessionId,
            'phoneNumber' => $phoneNumber,
            'text' => $text
        ];

        if (empty($text)) {
            return $this->showMainMenu();
        }

        $textArray = explode('*', $text);
        $lastInput = end($textArray);

        // Handle exit
        if ($textArray[0] === '0') {
            return "END Thank you for using the Quiz System!";
        }

        switch ($textArray[0]) {
            case '1':
                return $this->handleAddQuestion($textArray);
            case '2':
                return $this->handleViewQuestions($textArray);
            default:
                return $this->showMainMenu();
        }
    }

    private function showMainMenu() {
        return "CON Welcome to Quiz System\n" .
               "1. Add Question\n" .
               "2. View Questions\n" .
               "0. Exit";
    }

    private function handleAddQuestion($textArray) {
        $step = count($textArray);
        
        switch ($step) {
            case 1:
                return "CON Enter the question text:";
            case 2:
                return "CON Enter option A:";
            case 3:
                return "CON Enter option B:";
            case 4:
                return "CON Enter option C:";
            case 5:
                return "CON Enter option D:";
            case 6:
                return "CON Enter correct answer (A/B/C/D):";
            case 7:
                $result = $this->questionModel->addQuestion(
                    $textArray[1], // question
                    $textArray[2], // option A
                    $textArray[3], // option B
                    $textArray[4], // option C
                    $textArray[5], // option D
                    $textArray[6]  // correct answer
                );
                return "END Question " . ($result ? "added successfully!" : "failed to add.");
            default:
                return "END Invalid input. Please try again.";
        }
    }

    private function handleViewQuestions($textArray) {
        $questions = $this->questionModel->getAllQuestions();
        
        if (empty($questions)) {
            return "END No questions available.";
        }

        // If only '2' is entered, show the list
        if (count($textArray) == 1) {
            $response = "CON Available Questions:\n";
            foreach ($questions as $index => $question) {
                $response .= ($index + 1) . ". " . substr($question['question_text'], 0, 30) . "...\n";
            }
            $response .= "0. Back to main menu";
            return $response;
        }

        // Handle back to main menu
        if (isset($textArray[1]) && $textArray[1] == '0') {
            return $this->showMainMenu();
        }

        // If user selects a question number
        $selected = intval($textArray[1]) - 1;
        if (isset($questions[$selected])) {
            $q = $questions[$selected];
            $response = "END Q: " . $q['question_text'] . "\n";
            $response .= "A) " . $q['option_a'] . "\n";
            $response .= "B) " . $q['option_b'] . "\n";
            $response .= "C) " . $q['option_c'] . "\n";
            $response .= "D) " . $q['option_d'] . "\n";
            $response .= "Correct: " . $q['correct_answer'];
            return $response;
        } else {
            return "END Invalid selection.";
        }
    }
} 