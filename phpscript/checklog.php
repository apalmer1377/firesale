<?php
  session_start();
    
  if (isset($_SESSION['user_email'])) {
    if (isset($_GET['logout'])) {
      $_SESSION = array();
      if (isset($_COOKIE[session_name()])) {
        set_cookie(session_name(),'',time() - 3600);
      }
      session_destroy();
      header('Location: ../pages/home.php',true,301);
      exit();
    } else {
?>
