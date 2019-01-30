<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/Baine/core/init.php';
  unset($_SESSION['SBUser']);
  header('Location: login.php');
?>
