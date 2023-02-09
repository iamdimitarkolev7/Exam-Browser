<?php
    session_start();

    if (isset($_SESSION['username'])) {
        session_unset();
        session_destroy();
        
        echo json_encode(['success' => true, 'message' => 'Successfully logged out!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Cannot log out unauthorized user!']);
    }
?>