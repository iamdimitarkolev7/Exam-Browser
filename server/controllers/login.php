<?php
    require_once '../models/user.php';
    require_once '../utils/testInputUtility.php';
    require_once '../utils/tokenUtility.php';

    header('Content-type: application/x-www-form-urlencoded');

    session_start();

    $errors = [];

    if ($_POST) {
        $username = isset($_POST['username']) ? testInput($_POST['username']) : '';
        $password = isset($_POST['password']) ? testInput($_POST['password']) : '';

        if (!$username) {
            $errors[] = 'Username is required';
        }

        if (!$password) {
            $errors[] = 'Password is required';
        }

        if ($username && $password) {
            $user = new User($username, $password, '', '', '', '');
            $userExist = $user->exists();

            if ($userExist) {
                $_SESSION['username'] = $username;
                $_SESSION['userId'] = $user->getUserId();
                $_SESSION['userRole'] = $user->getRole();
            } else {
                $errors[] = 'User does not exist!';
            }
        }
    } else {
        $errors[] = 'Invalid request!';
    }

    if ($errors) {
        http_response_code(401);

        echo json_encode(['success' => false, 'message' => $errors]);
    } else {
        http_response_code(200);
        echo json_encode(['success' => true,
                          'message' => 'User logged in',
                          'username' => $_SESSION['username'],
                          'role' => $_SESSION['userRole']]);
    }
?>