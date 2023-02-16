<?php
  require_once '../models/test.php';
  require_once '../utils/testInputUtility.php';
  require_once '../models/user.php';

  session_start();
  header('Content-type: application/x-www-form-urlencoded');

  $errors = [];

  $testName = isset($_GET['testName']) ? testInput($_GET['testName']) : '';
  $test = new Test('', $testName, '', '', '');

  $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
  $user = new User($username, '', '', '', '', '');

  $resultGrade = '';
  $studentsData;

  if ($user->exists()) {
    $resultGrade = $user->getResultGrade();
    $studentsData = $user->selectAllStudents();
  }

  if (isset($_GET['testName'])) {
    $testExists = $test->testExists();

    if ($testExists) {
      $testsData[] = [
        'id' => $test->getId(),
        'testName' => $test->getTestName(),
        'questions' => $test->getQuestions(),
        'answers' => $test->getAnswers(),
        'correctAnswers' => $test->getCorrectAnswers()
      ];
    } else {
      $errors[] = 'No such test';
    }
  } else {
    $testsData = $test->selectTestsQuery();
  }

  if ($errors) {
     http_response_code(400);
     echo json_encode([
      'success' => false,
      'message' => $errors]);
  } else {
    http_response_code(200);
    echo json_encode([
      'success' => true,
      'message' => 'Request is successful',
      'testsData' => $testsData,
      'resultGrade' => $resultGrade,
      'createdTests' => $user->getCreatedTests(),
      'allUsersData' => $studentsData]);
  }
?>