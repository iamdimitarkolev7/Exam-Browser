<?php
    require_once 'user.php';
    require_once 'testInputUtility.php';
    require_once 'tokenUtility.php';

    header('Content-type: application/json');

    session_start();

    $errors = [];

    if ($_POST) {
        $data = json_decode($_POST['data'], true);

        $username = isset($data['userName']) ? testInput($data['userName']) : '';
        $password = isset($data['password']) ? testInput($data['password']) : '';
        $remember = isset($data['remember']) ? $data['remember'] : false;

        if (!$username) {
            $errors[] = 'Username is required';
        }

        if (!$password) {
            $errors[] = 'Password is required';
        }

        if ($username && $password) {
            $user = new User($username, $password);
            $userExist = $user->exists();

            if ($userExist) {
                $isValid = $user->isValid($password);

                if ($isValid) {
                    $_SESSION['username'] = $username;
                    $_SESSION['userId'] = $user->getUserId();

                    if($remember) {
                        $tokenHash = bin2hex(random_bytes(8));
                        $expires = time() + 60 * 60 * 24 * 30;
                        $token = new TokenUtility();
                        $token->createToken($tokenHash, $user->getUserId(), $expires);

                        setcookie('remember', $tokenHash, $expires, '/');
                    }
                } else {
                    $errors[] = 'Password is invalid';
                }
            } else {
                $errors[] = $userExist;
            }
        }
    } else {
        $errors[] = 'Invalid request!';
    }

    if ($errors) {
        http_response_code(401);

        echo json_encode(['success' => false, 'message' => $errors]);
    } else {
        echo json_encode(['success' => true, 'message' => 'User logged in']);
    }
?>