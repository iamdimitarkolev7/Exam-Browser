<?php
  require_once '../models/test.php';
  require_once '../utils/testInputUtility.php';

  session_start();
  header('Content-type: application/x-www-form-urlencoded');

  $errors = [];

  if ($_POST) {
    $id = uniqid();
    $testName = isset($_POST['testName']) ? testInput($_POST['testName']) : '';
    $questions = isset($_POST['questions']) ? testInput($_POST['questions']) : '';
    $answers = isset($_POST['answers']) ? testInput($_POST['answers']) : '';
    $correctAnswers =  isset($_POST['correctAnswers']) ? testInput($_POST['correctAnswers']) : '';
  
    $test = new Test($id, $testName, $questions, $answers, $correctAnswers);

    if ($test->testExists()) {
      $errors[] = 'This test currently exists!';
    } else {
      $test->createTest($id, $testName, $questions, $answers, $correctAnswers);
    }
  } else {
    $errors[] = 'Invalid request!';
  }

  if ($errors) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $errors]);
  } else {
    http_response_code(200);

    echo json_encode([
      'succes' => true,
      'message' => 'Test successfully added to the database'
    ]);
  }
?>