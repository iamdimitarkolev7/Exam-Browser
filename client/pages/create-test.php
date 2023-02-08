<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8"/>
  <title>Exam Browser</title>
  <script defer src="../scripts/utilities.js"></script>
  <script defer src="../scripts/login.js"></script>
  <link rel="stylesheet" href="../styles/styles.css"/>
  <link rel="stylesheet" href="../styles/nav.css"/>
  <link rel="stylesheet" href="../styles/create-test.css">
</head>
<body>
  <nav class="navbar">
    <a href="./index.php" class="logo">
      <img src="../../images/logo.png" alt="logo">
      <p class="logo-text">Exam Browser</p>
    </a>
    <ul>
      <li><a class="links" href="./login.php">Sign In</a></li>
      <li><a class="links" href="./register.php">Sign Up</a></li>
    </ul>
  </nav>
  <div id="errors">
    <p class="error-msg"></p>
  </div>
  <form class="create-json-form">
<<<<<<< Updated upstream:client/pages/create-test.php
    <p class="json-info-txt">Upload a json file that contains following information:
=======
    <p class="json-info-txt">Upload a json file that contains following information: </p>
>>>>>>> Stashed changes:client/pages/create-test.html
        <ul class="json-info-list">
            <li>N questions with 4 possibilities</li>
            <li>Correct answer for every question</li>
        </ul>
    <button id="create-json-button" type="submit">UPLOAD JSON</button>
  </form>
</body>
</html>