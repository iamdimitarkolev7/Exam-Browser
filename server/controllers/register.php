<?php
    require_once '../models/user.php';
    require_once '../utils/testInputUtility.php';

    header('Content-type: application/x-www-form-urlencoded');

    $errors = [];

    if ($_POST) {
        $username = isset($_POST['userName']) ? testInput($_POST['userName']) : '';
        $password = isset($_POST['password']) ? testInput($_POST['password']) : '';
        $confirmPassword = isset($_POST['confirmPassword']) ? testInput($_POST['confirmPassword']) : '';
        $email = isset($_POST['email']) ? testInput($_POST['email']) : '';

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
                $user = new User($username, $password);
                $userExist = $user->exists();

                if ($userExist) {
                    $errors[] = 'User already exists';
                } else {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $user->createUser($passwordHash, $email);
                }
            }
        }
    } else {
        $errors[] = 'Invalid request!';
    }

    if ($errors) {
        echo json_encode(['success' => false, 'message' => $errors]);
    } else {
        echo json_encode(['success' => true, 'message' => 'User created successfully']);
    }
?>