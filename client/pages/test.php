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
  <link rel="stylesheet" href="../styles/create-test.css">
  <script src="../scripts/utilities.js"></script>
  <script src="../scripts/index.js"></script>
  <script type="text/javascript" src="../scripts/testUtilities.js"></script>
  <script type="text/javascript" src="../scripts/test.js"></script>
  <script type="text/javascript" src="../scripts/logout.js"></script>
</head>
<body onload="loadTest()">
  
</body>
</html>