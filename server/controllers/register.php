<?php
    require_once '../models/user.php';
    require_once '../utils/testInputUtility.php';

    session_start();
    header('Content-type: application/x-www-form-urlencoded');

    $errors = [];

    if ($_POST) {
        $id = uniqid();
        $firstName = isset($_POST['firstName']) ? testInput($_POST['firstName']) : '';
        $lastName = isset($_POST['lastName']) ? testInput($_POST['lastName']) : '';
        $username = isset($_POST['username']) ? testInput($_POST['username']) : '';
        $password = isset($_POST['password']) ? testInput($_POST['password']) : '';
        $confirmPassword = isset($_POST['confirmPassword']) ? testInput($_POST['confirmPassword']) : '';
        $role = isset($_POST['role']) ? testInput($_POST['role']) : '';

        if (!$firstName) {
            $errors[] = 'First Name is required';
        }

        if (!$lastName) {
            $errors[] = 'Last Name is required';
        }

        if (!$username) {
            $errors[] = 'Username is required';
        }

        if (!$password) {
            $errors[] = 'Password is required';
        }

        if (!$confirmPassword) {
            $errors[] = 'Confirm password is required';
        }

        if ($username && $password && $confirmPassword) {
            if ($confirmPassword !== $password) {
                $errors[] = 'Confirm password does not match password';
            } else {
                $user = new User($username, $password, $id, $firstName, $lastName, $role);
                $userExist = $user->exists();

                if ($userExist) {
                    $errors[] = 'User already exists';
                } else {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $user->createUser($id, $firstName, $lastName, $username, $passwordHash, $role);
                }
            }
        }
    } else {
        $errors[] = 'Invalid request!';
    }

    if ($errors) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => $errors]);
    } else {
        http_response_code(200);
        
        $_SESSION['userId'] = $id;
        $_SESSION['userRole'] = $role;
        $_SESSION['username'] = $username;

        echo json_encode([
            'success' => true,
            'message' => 'User created successfully',
            'id' => $id,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'username' => $username,
            'role' => $role]);
    }
?>