<?php
  session_start();
  // if (isset($_SESSION['username'])) {
  //   echo('Authorized!');
  // } else {
  //   echo('Unauthorized');
  // }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Exam Browser</title>
  <script src="../scripts/utilities.js"></script>
  <script src="../scripts/index.js"></script>
  <script src="../scripts/logout.js"></script>
  <link rel="stylesheet" href="../styles/styles.css"/>
  <link rel="stylesheet" href="../styles/nav.css"/>
</head>
<body onload="loadSession()">
  <nav class="navbar">
    <a href="./index.php" class="logo">
      <img src="../../images/logo.png" alt="logo">
      <p class="logo-text">Exam Browser</p>
    </a>
    <ul>
      <li><a class="links" id="sign-in-btn" href="./register.php">Register</a></li>
      <li><a class="links" id="sign-up-btn" href="./login.php">Login</a></li>
      <li><a class="links" id="show-tests-btn" href="./register.php">Show Tests</a></li>
      <li><a class="links" id="create-test-btn" href="./register.php">Create Test</a></li>
      <li><a class="links" id="my-profile-btn" href="./register.php">My Profile</a></li>
      <li><a class="links" id="logout-btn" onclick="logout(event)">Logout</a></li>
    </ul>
  </nav>
</body>
</html>
