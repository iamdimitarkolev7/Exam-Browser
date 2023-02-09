<?php
    require_once "../db/db.php";

    class Test {
        private $id;
        private $testName;
        private $questions;
        private $answers;
        private $correctAnswers;

        private $db;

        public function __construct($id, $testName, $questions, $answers, $correctAnswers) {
            $this->db = new Database();

            $this->id = $id;
            $this->testName = $testName;
            $this->questions = $questions;
            $this->answers = $answers;
            $this->correctAnswers = $correctAnswers;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getId() {
            return $this->id;
        }

        public function setTestName($testName) {
            $this->testName = $testName;
        }

        public function getTestName() {
            return $this->testName;
        }

        public function setQuestions($questions) {
            $this->questions = $questions;
        }

        public function getQuestions() {
            return $this->questions;
        }

        public function setAnswers($answers) {
            $this->answers = $answers;
        }

        public function getAnswers() {
            return $this->answers;
        }

        public function setCorrectAnswers($correctAnswers) {
            $this->correctAnswers = $correctAnswers;
        }

        public function getCorrectAnswers() {
            return $this->correctAnswers;
        }

        public function createTest($id, $testName, $questions, $answers, $correctAnswers) {
            $query = $this->db->insertTestQuery([
                'id' => $id,
                'testName' => $testName,
                'questions' => $questions,
                'answers' => $answers,
                'correctAnswers' => $correctAnswers]);

            if ($query['success']) {
                $this->id = $id;
                $this->testName = $testName;
                $this->questions = $questions;
                $this->answers = $answers;
                $this->correctAnswers = $correctAnswers;
            }
        }

        public function selectTestsQuery() {
            $query = $this->db->selectTestsQuery();

            if (!$query['success']) {
                return;
            }

            return $query['data'];
        }
    }
?>