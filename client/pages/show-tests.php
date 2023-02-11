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
  <link rel="stylesheet" href="../styles/nav.css"/>
  <link rel="stylesheet" href="../styles/show-tests.css">
  <script src="../scripts/utilities.js"></script>
  <script src="../scripts/index.js"></script>
  <script type="text/javascript" src="../scripts/testUtilities.js"></script>
  <script type="text/javascript" src="../scripts/showTests.js"></script>
  <script type="text/javascript" src="../scripts/logout.js"></script>
</head>
<body onload="loadAllTests()">
  <nav class="navbar">
    <a href="./index.php" class="logo">
      <img src="../../images/logo.png" alt="logo">
      <p class="logo-text">SEB</p>
    </a>
    <ul>
      <li><a class="links" id="create-test-btn" href="./show-tests.php">Show Test</a></li>
      <li><a class="links" id="my-profile-btn" href="./register.php">My Profile</a></li>
      <li><a class="links" id="logout-btn" onclick="logout(event)">Logout</a></li>
    </ul>
  </nav>
  <div id="tests-section">
    <table id="tests-table">
      <thead>
        <tr class="table-heading-row">
          <th class="table-heading">№</th>
          <th class="table-heading">Test Name</th>
          <th class="table-heading">Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</body>
</html>