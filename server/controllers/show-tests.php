<?php
  require_once '../models/test.php';
  require_once '../utils/testInputUtility.php';

  session_start();
  header('Content-type: application/x-www-form-urlencoded');

  $errors = [];

  $test = new Test('', '', '', '', '');
  $testsData = $test->selectTestsQuery();

  http_response_code(200);
  echo json_encode([
    'success' => true,
    'message' => 'Tests loaded successfully',
    'testsData' => $testsData]);
?>