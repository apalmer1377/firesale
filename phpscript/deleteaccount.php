<?php
session_start();
$dbconn = new mysqli('localhost','austinpalmer','thereisnone1!','firesale');
$delquer = $dbconn->query('DELETE FROM users WHERE email="' . $_SESSION['user_email'] . '"');
$_SESSION = array();
if (isset($_COOKIE[session_name()])) {
  setcookie(session_name(),'',time()-3600);
}
session_destroy();
$dbconn->close();
header('Location: ../pages/home.php',true,301);
?>
