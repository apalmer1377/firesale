<?php
  session_start();
  $checkarr = array();
  $dbconn = new mysqli('localhost','austinpalmer','thereisnone1!','firesale');
  $checkit = $dbconn->query('SELECT * FROM users WHERE email="' . $_SESSION['user_email'] . '"');
    $row = $checkit->fetch_assoc();
    if (sha1($_GET['pass']) == $row['password']) {
      $checkarr['pass'] = 1;
    } else {
      $checkarr['pass'] = 0;
    }
  $charr = json_encode($checkarr);
  echo $charr;
?>
