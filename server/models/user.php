<?php
    require_once "../db/db.php";

    class User {
        private $id;
        private $firstName;
        private $lastName;
        private $username;
        private $password;
        private $role;

        private $db;

        public function __construct($username, $password, $id, $firstName, $lastName, $role) {
            $this->id = $id;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->username = $username;
            $this->password = $password;
            $this->role = $role;

            $this->db = new Database();
        }

        public function getUserId() {
            return $this->id;
        }

        public function getFirstName() {
            return $this->firstName;
        }

        public function getLastName() {
            return $this->lastName;
        }

        public function getUsername() {
            return $this->username;
        }

        public function getPassword() {
            return $this->password;
        }

        public function getRole() {
            return $this->role;
        }

        public function exists() {
            $selectUser = $this->db->selectUserQuery(['username' => $this->username]);

            if ($selectUser['success']) {
                $userData = $selectUser['data']->fetch(PDO::FETCH_ASSOC);

                if ($userData) {
                    $this->password = $userData['password'];
                    $this->id = $userData['id'];
                    $this->role = $userData['role'];

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
                    return password_verify($password, $user['password']);
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function createUser($id, $firstName, $lastName, $username, $passwordHash, $role) {
            $query = $this->db->insertUserQuery([
                'id' => $id,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'username' => $username,
                'password' => $passwordHash,
                'role' => $role]);

            if ($query['success']) {
                $this->id = $id;
                $this->firstName = $firstName;
                $this->lastName = $lastName;
                $this->username = $username;
                $this->password = $passwordHash;
                $this->role = $role;
            }
        }
    }
?>