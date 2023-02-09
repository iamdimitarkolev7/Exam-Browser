<?php
  session_start();
  if (isset($_SESSION['username'])) {
    header("location: index.php");
  }
?>
<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8"/>
  <title>Exam Browser</title>
  <script defer src="../scripts/utilities.js"></script>
  <script defer src="../scripts/login.js"></script>
  <link rel="stylesheet" href="../styles/styles.css"/>
  <link rel="stylesheet" href="../styles/nav.css"/>
  <link rel="stylesheet" href="../styles/login.css"/>
</head>
<body>
<nav class="navbar">
    <a href="./index.php" class="logo">
      <img src="../../images/logo.png" alt="logo">
      <p class="logo-text">SEB</p>
    </a>
    <ul>
      <li><a class="links" href="./register.php">Register</a></li>
      <li><a class="links" href="./login.php">Login</a></li>
    </ul>
  </nav>
  <div id="errors">
    <p class="error-msg"></p>
  </div>
  <form id="login-form">
    <p class="form-title">Login</p>
    <div class="login-form-input">
      <input type="text" placeholder="Username" id="username"/>
    </div>
    <div class="login-form-input">
      <input type="password" placeholder="Password" id="password"/>
    </div>
    <button id="login-btn" type="submit">Login</button>
  </div>
</body>
</html>
