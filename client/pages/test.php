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
  <link rel="stylesheet" href="../styles/test.css">
  <script src="../scripts/utilities.js"></script>
  <script src="../scripts/index.js"></script>
  <script type="text/javascript" src="../scripts/testUtilities.js"></script>
  <script type="text/javascript" src="../scripts/test.js"></script>
  <script type="text/javascript" src="../scripts/logout.js"></script>
</head>
<body onload="loadTest()">
  <h1></h1>
  <div class="quiz-container">
    <div id="quiz"></div>
    <div id="button-section">
      <button id="previous">Previous Question</button>
      <button id="next">Next Question</button>
      <button id="submit">Submit Quiz</button>
      <button id="home">Back to Home</button>
    </div>
  </div>
  <div id="results"></div>
  <div id="grade"></div>
</body>
</html>