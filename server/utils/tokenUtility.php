<?php
  require_once "db.php";

  /**
   * Use this class to manage user session tokens
   */
  class TokenUtility {
      private $db;

      public function __construct() {
          $this->db = new Database();
      }

      /**
       * Create user session token
       */
      public function createToken($token, $userId, $expires) {
        $this->db->insertTokenQuery(array("token" => $token, "user_id" => $userId, "expires" => $expires));
      }

      /**
       * Check whether the token is valid
       */
      public function checkToken($token) {
        $tokenQuery = $this->db->selectToken(['token' => $token]);

        if ($tokenQuery['success']) {
          $token = $tokenQuery['data']->fetch(PDO::FETCH_ASSOC);

          if ($token) {
            if (time() > $token['expires']) {
              return ['success' => false, 'error' => 'Token expired'];
            }

            $user = $this->db->selectUserByIdQuery(['id' => $token['user_id']]);

            return ['success' => true, 'data' => $user->fetch(PDO::FETCH_ASSOC)];
          }

          return ['success' => false, 'error' => 'Token invalid'];
        } 

        return ['success' => false, 'error' => 'Db error'];
      }
  }
?>