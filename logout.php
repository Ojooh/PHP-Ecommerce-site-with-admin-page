<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/Baine/core/init.php';
  unset($_SESSION['SBCustomer']);
  header('Location: /Baine/index.php');
?>
