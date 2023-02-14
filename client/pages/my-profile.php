<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Exam Browser</title>
  <script src="../scripts/utilities.js"></script>
  <script src="../scripts/index.js"></script>
  <script src="../scripts/logout.js"></script>
  <script src="../scripts/my-profile.js"></script>
  <link rel="stylesheet" href="../styles/styles.css"/>
  <link rel="stylesheet" href="../styles/nav.css"/>
  <link rel="stylesheet" href="../styles/my-profile.css"/>
</head>
<body onload="loadSessionMyProfile()">
  <nav class="navbar">
    <a href="./index.php" class="logo">
      <img src="../../images/logo.png" alt="logo">
      <p class="logo-text">SEB</p>
    </a>
    <ul>
      <li><a class="links" id="show-tests-btn" href="./show-tests.php">Show Tests</a></li>
      <li><a class="links" id="my-profile-btn" href="./my-profile.php">My Profile</a></li>
      <li><a class="links" id="logout-btn" onclick="logout(event)">Logout</a></li>
    </ul>
  </nav>
  <p class="created-tests-title">You have created the following tests:</p>
  <div id="created-tests">
    <table id="created-tests-table">
      <thead>
        <tr class="table-heading-row">
          <th class="table-heading">№</th>
          <th class="table-heading">Test Name</th>
          <th class="table-heading">Performed</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <p class="performed-tests-title">You have performed the following tests:</p>
  <div id="performed-tests">
    <table id="performed-tests-table">
      <thead>
        <tr class="table-heading-row">
          <th class="table-heading">№</th>
          <th class="table-heading">Test Name</th>
          <th class="table-heading">Grade</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <p class="all-tests-title">All performed tests and grades:</p>
  <div id="all-students-tests">
    <table id="students-tests-table">
      <thead>
        <tr class="table-heading-row">
          <th class="table-heading">Student</th>
          <th class="table-heading">Test Name</th>
          <th class="table-heading">Grade</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</body>
</html>
