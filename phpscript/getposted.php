<?php 
session_start();
$arr = '[';
$dbconn = new mysqli('localhost','austinpalmer','thereisnone1!','firesale');
      $quer = 'SELECT colleges.name as college_posted,textbooks.* FROM colleges,textbooks WHERE textbooks.posted_by="' . $_SESSION["user_email"] . '" AND colleges.abbreviation=textbooks.college AND textbooks.pictures=0';
      $accdata = $dbconn->query($quer);
      while ($row=$accdata->fetch_assoc()) {
        if ($arr != '[') {
          $arr .= ',';
        }
        $arr .= json_encode($row);
      }
      $quer = 'SELECT colleges.name as college_posted,sublets.* FROM colleges,sublets WHERE sublets.posted_by="' . $_SESSION['user_email'] . '" AND colleges.abbreviation=sublets.college AND sublets.pictures=0';
      $accdata = $dbconn->query($quer);
            while ($row=$accdata->fetch_assoc()) {
        if ($arr != '[') {
          $arr .= ',';
        }
        $arr .= json_encode($row);
      }
      $quer = 'SELECT colleges.name as college_posted,services.* FROM colleges,services WHERE services.posted_by="' . $_SESSION['user_email'] . '" AND colleges.abbreviation=services.college AND services.pictures=0';
      $accdata = $dbconn->query($quer);
            while ($row=$accdata->fetch_assoc()) {
        if ($arr != '[') {
          $arr .= ',';
        }
        $arr .= json_encode($row);
      }
      $quer = 'SELECT colleges.name as college_posted,misc.* FROM colleges,misc WHERE misc.posted_by="' . $_SESSION['user_email'] . '" AND colleges.abbreviation=misc.college AND misc.pictures=0';
      $accdata = $dbconn->query($quer);
            while ($row=$accdata->fetch_assoc()) {
        if ($arr != '[') {
          $arr .= ',';
        }
        $arr .= json_encode($row);
      }
      
      $quer = 'SELECT colleges.name as college_posted,textbooks.*,concat_ws("/","../images/client",' . $_SESSION['ID'] . ',textbooks_pictures.picture1) as pic1,concat_ws("/","../images/client",' . $_SESSION['ID'] . ',textbooks_pictures.picture2) as pic2,concat_ws("/","../images/client",' . $_SESSION['ID'] . ',textbooks_pictures.picture3) as pic3,concat_ws("/","../images/client",' . $_SESSION['ID'] . ',textbooks_pictures.picture4) as pic4,concat_ws("/","../images/client",' . $_SESSION['ID'] . ',textbooks_pictures.picture5) as pic5 FROM colleges,textbooks,textbooks_pictures WHERE textbooks.posted_by="' . $_SESSION['user_email'] . '" AND colleges.abbreviation=textbooks.college AND textbooks.pictures=1 AND textbooks_pictures.id=textbooks.ID';
      $accdata = $dbconn->query($quer);
      while ($row=$accdata->fetch_assoc()) {
        if ($arr != '[') {
          $arr .= ',';
        }
        $arr .= json_encode($row);
      }
      
      $quer = 'SELECT colleges.name as college_posted,sublets.*,concat_ws("/","../images/client",' . $_SESSION['ID'] . ',sublets_pictures.picture1) as pic1,concat_ws("/","../images/client",' . $_SESSION['ID'] . ',sublets_pictures.picture2) as pic2,concat_ws("/","../images/client",' . $_SESSION['ID'] . ',sublets_pictures.picture3) as pic3,concat_ws("/","../images/client",' . $_SESSION['ID'] . ',sublets_pictures.picture4) as pic4,concat_ws("/","../images/client",' . $_SESSION['ID'] . ',sublets_pictures.picture5) as pic5 FROM colleges,sublets,sublets_pictures WHERE sublets.posted_by="' . $_SESSION['user_email'] . '" AND colleges.abbreviation=sublets.college AND sublets.pictures=1 AND sublets_pictures.id=sublets.ID';
      $accdata = $dbconn->query($quer);
      while ($row=$accdata->fetch_assoc()) {
        if ($arr != '[') {
          $arr .= ',';
        }
        $arr .= json_encode($row);
      }
      
      $quer = 'SELECT colleges.name as college_posted,services.*,concat_ws("/","../images/client",' . $_SESSION['ID'] . ',services_pictures.picture1) as pic1,concat_ws("/","../images/client",' . $_SESSION['ID'] . ',services_pictures.picture2) as pic2,concat_ws("/","../images/client",' . $_SESSION['ID'] . ',services_pictures.picture3) as pic3,concat_ws("/","../images/client",' . $_SESSION['ID'] . ',services_pictures.picture4) as pic4,concat_ws("/","../images/client",' . $_SESSION['ID'] . ',services_pictures.picture5) as pic5 FROM colleges,services,services_pictures WHERE services.posted_by="' . $_SESSION['user_email'] . '" AND colleges.abbreviation=services.college AND services.pictures=1 AND services_pictures.id=services.ID';
      $accdata = $dbconn->query($quer);
      while ($row=$accdata->fetch_assoc()) {
        if ($arr != '[') {
          $arr .= ',';
        }
        $arr .= json_encode($row);
      }
      
      $quer = 'SELECT colleges.name as college_posted,misc.*,concat_ws("/","../images/client",' . $_SESSION['ID'] . ',misc_pictures.picture1) as pic1,concat_ws("/","../images/client",' . $_SESSION['ID'] . ',misc_pictures.picture2) as pic2,concat_ws("/","../images/client",' . $_SESSION['ID'] . ',misc_pictures.picture3) as pic3,concat_ws("/","../images/client",' . $_SESSION['ID'] . ',misc_pictures.picture4) as pic4,concat_ws("/","../images/client",' . $_SESSION['ID'] . ',misc_pictures.picture5) as pic5 FROM colleges,misc,misc_pictures WHERE misc.posted_by="' . $_SESSION['user_email'] . '" AND colleges.abbreviation=misc.college AND misc.pictures=1 AND misc_pictures.id=misc.ID';
      $accdata = $dbconn->query($quer);
      while ($row=$accdata->fetch_assoc()) {
        if ($arr != '[') {
          $arr .= ',';
        }
        $arr .= json_encode($row);
      }
      
      $arr .=']';
      echo $arr;
?>