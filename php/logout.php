<?php
  session_start();
  $_SESSION['loggedin'] = 0;
  header('Location: ../home.php');
?>
