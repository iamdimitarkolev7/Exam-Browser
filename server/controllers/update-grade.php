<?php
  require_once '../models/test.php';
  require_once '../models/user.php';
  require_once '../utils/testInputUtility.php';

  header('Content-type: application/x-www-form-urlencoded');

  session_start();

  $errors = [];

  if ($_POST) {
    $resultGrade = isset($_POST['resultGrade']) ? testInput($_POST['resultGrade']) : '';
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

    $user = new User($username, '', '', '', '', '');

    if ($user->exists()) {
      $user->updateGrades($resultGrade, $username);
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
        'success' => true,
        'message' => 'Grades updated successfully'
      ]);
  }
?>
