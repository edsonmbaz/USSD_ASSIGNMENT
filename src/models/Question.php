<?php

class Question {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addQuestion($questionText, $optionA, $optionB, $optionC, $optionD, $correctAnswer) {
        $sql = "INSERT INTO questions (question_text, option_a, option_b, option_c, option_d, correct_answer) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$questionText, $optionA, $optionB, $optionC, $optionD, $correctAnswer]);
    }

    public function getAllQuestions() {
        $sql = "SELECT * FROM questions ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getQuestionById($id) {
        $sql = "SELECT * FROM questions WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
} 