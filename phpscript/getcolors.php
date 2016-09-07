<?php

    $dbconn = new mysqli('localhost','austinpalmer','thereisnone1!','firesale');
    $quer = "SELECT primary_color,secondary_color,college,ID FROM users WHERE email='" . $_SESSION['user_email'] . "'";
    $result = $dbconn->query($quer);
    $row = $result->fetch_assoc();
    $_SESSION['primary_color'] = $row['primary_color'];
    $_SESSION['secondary_color'] = $row['secondary_color'];
    $_SESSION['college'] = $row['college'];
    $_SESSION['ID'] = $row['ID'];
    $dbconn->close();

?>