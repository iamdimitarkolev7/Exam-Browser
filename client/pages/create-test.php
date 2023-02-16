<?php
  session_start();
  if (!isset($_SESSION['username'])) {
    header("location: index.php");
  }
?>
<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8"/>
  <title>Exam Browser</title>
  <link rel="stylesheet" href="../styles/styles.css"/>
  <link rel="stylesheet" href="../styles/alert.css"/>
  <link rel="stylesheet" href="../styles/nav.css"/>
  <link rel="stylesheet" href="../styles/create-test.css">
  <script src="../scripts/utilities.js"></script>
  <script src="../scripts/index.js"></script>
  <script type="text/javascript" src="../scripts/testUtilities.js"></script>
  <script type="text/javascript" src="../scripts/alertUtils.js"></script>
  <script type="text/javascript" src="../scripts/createTest.js"></script>
  <script type="text/javascript" src="../scripts/logout.js"></script>
</head>
<body>
  <nav class="navbar">
    <a href="./index.php" class="logo">
      <img src="../../images/logo.png" alt="logo">
      <p class="logo-text">SEB</p>
    </a>
    <ul>
      <li><a class="links" id="create-test-btn" href="./create-test.php">Create Test</a></li>
      <li><a class="links" id="my-profile-btn" href="./my-profile.php">My Profile</a></li>
      <li><a class="links" id="logout-btn" onclick="logout(event)">Logout</a></li>
    </ul>
  </nav>
  <div id="alert">
  </div>
  <form id="create-test-form" onsubmit="submitCreateTestForm(event)">
    <p class="json-info-txt">Upload a json file that contains following information:</p>
    <ul class="json-info-list">
      <li>N questions with 4 possibilities</li>
      <li>Correct answer for every question</li>
    </ul>
    <label for="file">File to upload</label>
	  <input type="file" id="file" accept=".json">
    <button id="create-test-button" type="submit">Create Test</button>
  </form>
</body>
</html>