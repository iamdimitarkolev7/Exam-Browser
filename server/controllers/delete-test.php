<?php
  require_once '../models/user.php';
  require_once '../models/test.php';
  require_once '../utils/testInputUtility.php';

  session_start();
  header('Content-type: application/x-www-form-urlencoded');

  $errors = [];

  if ($_POST) {
    $testName = isset($_POST['testName']) ? testInput($_POST['testName']) : '';
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
  
    $test = new Test('', $testName, '', '', '');
    $user = new User($username, '', '', '', '', '');

    if ($test->testExists() && $user->exists()) {
      if (!$test->deleteTestByName()) {
        $errors[] = 'Error occured while trying to delete the test';
      }

      $createdTests = explode('|', $user->getCreatedTests());
      
      if (in_array($testName, $createdTests)) {
        $index = array_search($testName, $createdTests);
        unset($createdTests[$index]);

        $new_result = implode('|', $createdTests);

        $user->deleteCreatedtest($new_result, $username);
      }
    }

    if ($errors) {
      http_response_code(400);
      echo json_encode(['success' => false, 'message' => $errors]);
    } else {
      http_response_code(200);
  
      echo json_encode([
          'success' => true,
          'message' => 'Test deleted successsfully'
        ]);
    }
  }
?>