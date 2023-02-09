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
  <script defer src="../scripts/register.js"></script>
  <link rel="stylesheet" href="../styles/styles.css"/>
  <link rel="stylesheet" href="../styles/nav.css"/>
  <link rel="stylesheet" href="../styles/register.css">
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
  <form id="register-form">
    <p class="form-title">Sign In</p>
    <div class="form-input">
      <input type="text" placeholder="First Name" id="first-name"/>
    </div>
    <div class="form-input">
      <input type="text" placeholder="Last Name" id="last-name"/>
    </div>
    <div class="form-input">
      <input type="text" placeholder="Username" id="username"/>
    </div>
    <fieldset class="form-fieldset">
      <legend>User role:</legend>
      <div>
        <input type="radio" id="teacher" name="teacher" value="teacher" onclick="checkTeacherBtn()" checked/>
        <label for="teacher">Teacher</label>

        <input type="radio" id="student" name="student" value="student" onclick="checkStudentBtn()"/>
        <label for="student">Student</label>
      </div>
    </fieldset>
    </div>
    <div class="form-input">
      <input type="password" placeholder="Password" id="password"/>
    </div>
    <div class="form-input">
      <input type="password" placeholder="Repeat Password" id="repeat-password"/>
    </div>
    <button id="sign-in-btn" type="submit">SIGN IN</button>
</form>
</body>
</html>
