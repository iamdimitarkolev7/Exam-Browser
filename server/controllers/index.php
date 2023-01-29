<?php
    require_once 'mark.php';
    require_once 'testInputUtility.php';

    header('Content-Type: application/json');

    session_start();

    if (isset($_SESSION['username'])) {
        echo json_encode(['success' => true, 'user' => $_SESSION['username']]);
    } else {
        if (isset($_COOKIE['remember'])) {
            $token = new TokenUtility();
            $isValid = $token->checkToken($_COOKIE['remember']);

            if ($isValid['success']) {
                $_SESSION['username'] = $isValid['data']['username'];
                $_SESSION['userId'] = $isValid['data']['id'];

                echo json_encode(['success' => true, 'message' => 'User authorized']);
            } else {
                http_response_code(401);

                echo json_encode($isValid);
            }
        } else {
            http_response_code(401);

            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
        }
    }
?>