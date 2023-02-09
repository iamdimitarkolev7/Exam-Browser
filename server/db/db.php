<?php
    class Database {
        private $connection;
        private $insertUser;
        private $selectUser;
        private $insertTest;
        private $selectTests;

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

        function __destruct() {
            $this->connection = null;
        }
    }
?>
