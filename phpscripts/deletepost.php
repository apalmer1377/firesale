<?php
  $type = $_GET['d'];
  $id = $_GET['id'];
  
  $dbconn = new mysqli('localhost','austinpalmer','thereisnone1!','firesale');
  $delpo = $dbconn->query('DELETE FROM ' . $type . ' WHERE ID="' . $id . '"');
  $dbconn->close();
  header('Location: ../pages/myaccount.php',true,301);
  
?>
