<?php
    class Database {
        private $connection;
        private $insertUser;
        private $selectUser;
        private $insertTest;
        private $selectTests;
        private $selectTestByName;
        private $updateUserGrade;
        private $updateCreatedTests;
        private $deleteTestByName;
        private $deleteCreatedTest;
        private $selectStudentsAndTheirGrades;

        public function __construct() {
            $config = parse_ini_file('../../config.ini', true);

            $type = $config['db']['db_type'];
            $host = $config['db']['host'];
            $name = $config['db']['db_name'];
            $user = $config['db']['user'];
            $password = $config['db']['password'];

            $this->init($type, $host, $name, $user, $password);
        }

        private function init($type, $host, $name, $user, $password) {
            try {
                $this->connection = new PDO("$type:host=$host;dbname=$name", $user, $password);

                $this->prepareStatements();
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }

        private function prepareStatements() {
            $sql = "SELECT * FROM users WHERE username = :username";
            $this->selectUser = $this->connection->prepare($sql);

            $sql = "INSERT INTO users(id, firstName, lastName, username, password, role) VALUES
                    (:id, :firstName, :lastName, :username, :password, :role)";
            $this->insertUser = $this->connection->prepare($sql);

            $sql = "INSERT INTO tests(id, testName, questions, answers, correctAnswers) VALUES
                    (:id, :testName, :questions, :answers, :correctAnswers)";
            $this->insertTest = $this->connection->prepare($sql);

            $sql = "SELECT * FROM tests";
            $this->selectTests = $this->connection->prepare($sql);

            $sql = "SELECT * FROM tests WHERE testName = :testName";
            $this->selectTestByName = $this->connection->prepare($sql);

            $sql = "UPDATE users SET resultGrade = CONCAT(resultGrade, :resultGrade) WHERE username = :username";
            $this->updateUserGrade = $this->connection->prepare($sql);

            $sql = "UPDATE users SET createdTests = CONCAT(createdTests, :createdTests) WHERE username = :username";
            $this->updateCreatedTests = $this->connection->prepare($sql);

            $sql = "DELETE FROM tests WHERE testName = :testName";
            $this->deleteTestByName = $this->connection->prepare($sql);

            $sql = "UPDATE users SET createdTests = :createdTests WHERE username = :username";
            $this->deleteCreatedTest = $this->connection->prepare($sql);

            $sql = "SELECT firstname, lastname, resultGrade FROM users WHERE role = 1";
            $this->selectStudentsAndTheirGrades = $this->connection->prepare($sql);
        }

        public function selectUserQuery($data) {
            try {
                $this->selectUser->execute($data);

                return ["success" => true, "data" => $this->selectUser];
            } catch (PDOException $e) {
                return ["success" => false, "error" => $e->getMessage()];
            }
        }

        public function selectTestsQuery() {
            try {
                $this->selectTests->execute();
                return ["success" => true, "data" => $this->selectTests->fetchAll(PDO::FETCH_ASSOC)];
            } catch (PDOException $e) {
                return ["success" => false, "error" => $e->getMessage()];
            }
        }

        public function selectTestByName($testName) {
            try {
                $this->selectTestByName->execute($testName);
                return ["success" => true, "data" => $this->selectTestByName->fetchAll(PDO::FETCH_ASSOC)];
            } catch (PDOException $e) {
                return ["success" => false, "error" => $e->getMessage()];
            }
        }

        public function insertUserQuery($data) {
            try {
                $this->insertUser->execute($data);
                return ["success" => true];
            } catch (PDOException $e) {
                $this->connection->rollBack();
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function insertTestQuery($data) {
            try {
                $this->insertTest->execute($data);
                return ["success" => true];
            } catch(PDOException $e) {
                $this->connection->rollBack();
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function updateUserGradeQuery($data) {
            try {
                $this->updateUserGrade->execute($data);
                return ["success" => true, "data" => $this->updateUserGrade->fetchAll(PDO::FETCH_ASSOC)];
            } catch (PDOException $e) {
                return ["success" => false, "error" => $e->getMessage()];
            }
        }

        public function updateCreatedTests($data) {
            try {
                $this->updateCreatedTests->execute($data);
                return ["success" => true, "data" => $this->updateCreatedTests->fetchAll(PDO::FETCH_ASSOC)];
            } catch (PDOException $e) {
                return ["success" => false, "error" => $e->getMessage()];
            }
        }

        public function deleteTestByName($data) {
            try {
                $this->deleteTestByName->execute($data);
                return ["success" => true, "data" => $this->deleteTestByName->fetchAll(PDO::FETCH_ASSOC)];
            } catch (PDOException $e) {
                return ["success" => false, "error" => $e->getMessage()];
            }
        }

        public function deleteCreatedTest($data) {
            try {
                $this->deleteCreatedTest->execute($data);
                return ["success" => true, "data" => $this->deleteTestByName->fetchAll(PDO::FETCH_ASSOC)];
            } catch (PDOException $e) {
                return ["success" => false, "error" => $e->getMessage()];
            }
        }

        public function getStudentsData() {
            try {
                $this->selectStudentsAndTheirGrades->execute();
                return ["success" => true, "data" => $this->selectStudentsAndTheirGrades->fetchAll(PDO::FETCH_ASSOC)];
            } catch (PDOException $e) {
                return ["success" => false, "error" => $e->getMessage()];
            }
        }

        function __destruct() {
            $this->connection = null;
        }
    }
?>
