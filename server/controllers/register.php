<?php
    require_once 'user.php';
    require_once 'testInputUtility.php';

    header('Content-type: application/json');

    $errors = [];

    if ($_POST) {
        $data = json_decode($_POST['data'], true);

        $username = isset($data['userName']) ? testInput($data['userName']) : '';
        $password = isset($data['password']) ? testInput($data['password']) : '';
        $confirmPassword = isset($data['confirmPassword']) ? testInput($data['confirmPassword']) : '';
        $email = isset($data['email']) ? testInput($data['email']) : '';

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