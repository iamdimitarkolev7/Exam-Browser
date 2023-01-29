<?php
    require_once "db.php";

    class User {
        private $username;
        private $password;
        private $email;
        private $userId;

        private $db;

        public function __construct($username, $password) {
            $this->username = $username;
            $this->password = $password;

            $this->db = new Database();
        }

        public function getUsername() {
            return $this->username;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getUserId() {
            return $this->userId;
        }

        public function exists() {
            $selectUser = $this->db->selectUserQuery(['username' => $this->username]);

            if ($selectUser['success']) {
                $userData = $selectUser['data']->fetch(PDO::FETCH_ASSOC);

                if ($userData) {
                    $this->password = $userData['password'];
                    $this->email = $userData['email'];
                    $this->userId = $userData['id'];

                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function isValid($password) {
            $query = $this->db->selectUserQuery(["user" => $this->username]);

            if ($query["success"]) {
                $user = $query["data"]->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    return password_verify($this->password, $user['password']);
                } else {
                    return false;
                }             
            } else {
                return false;
            }
        }

        public function createUser($passwordHash, $email) {
            $query = $this->db->insertUserQuery(['username' => $this->username, 'password' => $passwordHash, 'email' => $email]);

            if ($query['success']) {
                $this->password = $passwordHash;
                $this->email = $email;
            }
        }
    }
?>