<?php
    require_once '../models/test.php';
    require_once '../utils/testInputUtility.php';

    header('Content-type: application/x-www-form-urlencoded');

    session_start();

    if (isset($_SESSION['username'])) {
        echo json_encode(['success' => true, 'user' => $_SESSION['username']]);
    } else {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    }
?>