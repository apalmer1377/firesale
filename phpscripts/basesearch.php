<?php
session_start();
$dbconn = new mysqli('localhost','austinpalmer','thereisnone1!','firesale');

switch($_GET['type']) {
  case 'books':
    $type = 'textbooks';
    break;
  case 'services':
    $type = 'services';
    break;
  case 'miscellaneous':
    $type = 'misc';
    break;
  default:
    break;
}

$co = 'SELECT ID AS count from ' . $type . ' ORDER BY ID DESC LIMIT 1';
$getco = $dbconn->query($co);
$getcoarr = $getco->fetch_assoc();
$numrows = $getcoarr['count'];
$lowrow = $numrows - 100;

$numres = 0;


$searchfield = str_replace(',','',str_replace('-',' ',strtolower(trim($_GET['searchinput']))));
if ($searchfield == '') {
  $searcharray = array();
} else {
//$searcharray = array_diff(explode(" ",$searchfield),array('the','for','and','a','an'));
$searcharray = array_diff(explode(" ",$searchfield),array(''));
}

if (empty($searcharray)) {
  echo '[]';
} else {
$getnear = $dbconn->query('SELECT * FROM nearby WHERE college="' . $_GET['college'] . '"');
$near = $getnear->fetch_assoc();

$reg = '/';
foreach ($searcharray as $word) {
  if ($reg != '/') {
    $reg .= '|';
  }
  $reg .= $word;
}
$reg .= '/';

$arr = '[';

while ($numres <= 100) {
  $getres = 'SELECT * from ' . $type . ' WHERE (ID BETWEEN 1 AND ' . $numrows . ') AND ( college="' . $near['college'] . '" OR college="' . $near['near1'] . '" OR college="' . $near['near2'] . '" OR college="' . $near['near3'] . '" OR college="' . $near['near4'] . '" OR college="' . $near['near5'] . '") ORDER BY ID DESC LIMIT 100';
  $search = $dbconn->query($getres);
  if ($search->num_rows > 0) {
  switch($_GET['type']) {
    case 'books':
      while ($row = $search->fetch_assoc()) {
        
        $lookfor = str_replace(',','',str_replace('-',' ',strtolower(trim($row['name']))));
        if (preg_match($reg,$lookfor) != false) {
        $numres += 1;
        
        if ($row['pictures']==1) {
          $getpics = 'SELECT * FROM ' . $type . '_pictures WHERE ID="' . $row['ID'] . '"';
          $pica = $dbconn->query($getpics);
          $p = $pica->fetch_assoc();
          for ($pin=0;$pin<5;$pin++) {
          if ($p['picture' . ($pin + 1)]) {
            $pi[$pin] = '../images/client/' . $p['posted_by'] . '/' . $p['picture' . ($pin + 1)];
          } else {
            $pi[$pin] = '';
          }
          }
        } else {
          $pi = array();
        }
        
        $getcoll = 'SELECT colleges.name from colleges,' . $type . ' WHERE ' . $type . '.ID="' . $row['ID'] . '" AND colleges.abbreviation="' . $row['college'] . '"';
        $coll = $dbconn->query($getcoll);
        $d = $coll->fetch_assoc();
        $colle = $d['name'];

        if ($arr != '[') {
          $arr .= ',';
        }
        $arr .= '{"Title":"' . $row['name'] . '",';
        $arr .= '"Edition":"' . $row['edition'] . '",';
        $arr .= '"Author":"' . $row['author'] . '",';
        $arr .= '"Publisher":"' . $row['publisher'] . '",';
        $arr .= '"Price":"' . $row['price'] . '",';
        $arr .= '"Description":"' . $row['description'] . '",';
        $arr .= '"Phone":"' . $row['phone'] . '",';
        $arr .= '"Email":"' . $row['email'] . '",';
        $arr .= '"College":"' . $colle . '",';
        $arr .= '"Pic1":"' . $pi[0] . '",';
        $arr .= '"Pic2":"' . $pi[1] . '",';
        $arr .= '"Pic3":"' . $pi[2] . '",';
        $arr .= '"Pic4":"' . $pi[3] . '",';
        $arr .= '"Pic5":"' . $pi[4] . '"}';
        }
      }
      
      break;

    case 'services':
      while ($row = $search->fetch_assoc()) {
        $lookfor = str_replace(',','',str_replace('-',' ',strtolower(trim($row['name']))));
        if (preg_match($reg,$lookfor) != false) {
        $numres += 1;
        
        if ($row['pictures']==1) {
          $getpics = 'SELECT * FROM ' . $type . '_pictures WHERE ID="' . $row['ID'] . '"';
          $pica = $dbconn->query($getpics);
          $p = $pica->fetch_assoc();
          for ($pin=0;$pin<5;$pin++) {
          if ($p['picture' . ($pin + 1)]) {
            $pi[$pin] = '../images/client/' . $p['posted_by'] . '/' . $p['picture' . ($pin + 1)];
          } else {
            $pi[$pin] = '';
          }
          }
        } else {
          $pi = array();
        }
        
        $getcoll = 'SELECT colleges.name from colleges,' . $type . ' WHERE ' . $type . '.ID="' . $row['ID'] . '" AND colleges.abbreviation="' . $row['college'] . '"';
        $coll = $dbconn->query($getcoll);
        $d = $coll->fetch_assoc();
        $colle = $d['name'];
        
        if ($arr != '[') {
          $arr .= ',';
        }
        $arr .= '{"Service":"' . $row['name'] . '",';
        $arr .= '"Price":"' . $row['price'] . '",';
        $arr .= '"Description":"' . $row['description'] . '",';
        $arr .= '"Phone":"' . $row['phone'] . '",';
        $arr .= '"Email":"' . $row['email'] . '",';
        $arr .= '"College":"' . $colle . '",';
        $arr .= '"Pic1":"' . $pi[0] . '",';
        $arr .= '"Pic2":"' . $pi[1] . '",';
        $arr .= '"Pic3":"' . $pi[2] . '",';
        $arr .= '"Pic4":"' . $pi[3] . '",';
        $arr .= '"Pic5":"' . $pi[4] . '"}';
        }
      }
      break;
    case 'miscellaneous':
      while ($row = $search->fetch_assoc()) {
        $lookfor = str_replace(',','',str_replace('-',' ',strtolower(trim($row['name']))));
        if (preg_match($reg,$lookfor) != false) {
        $numres += 1;
        
        if ($row['pictures']==1) {
          $getpics = 'SELECT * FROM ' . $type . '_pictures WHERE ID="' . $row['ID'] . '"';
          $pica = $dbconn->query($getpics);
          $p = $pica->fetch_assoc();
          for ($pin=0;$pin<5;$pin++) {
          if ($p['picture' . ($pin + 1)]) {
            $pi[$pin] = '../images/client/' . $p['posted_by'] . '/' . $p['picture' . ($pin + 1)];
          } else {
            $pi[$pin] = '';
          }
          }
        } else {
          $pi = array();
        }
        
        $getcoll = 'SELECT colleges.name from colleges,' . $type . ' WHERE ' . $type . '.ID="' . $row['ID'] . '" AND colleges.abbreviation="' . $row['college'] . '"';
        $coll = $dbconn->query($getcoll);
        $d = $coll->fetch_assoc();
        $colle = $d['name'];
        
        if ($arr != '[') {
          $arr .= ',';
        }
        $arr .= '{"Name":"' . $row['name'] . '",';
        $arr .= '"Price":"' . $row['price'] . '",';
        $arr .= '"Type":"' . $row['type'] . '",';
        $arr .= '"Description":"' . $row['description'] . '",';
        $arr .= '"Phone":"' . $row['phone'] . '",';
        $arr .= '"Email":"' . $row['email'] . '",';
        $arr .= '"College":"' . $colle . '",';
        $arr .= '"Pic1":"' . $pi[0] . '",';
        $arr .= '"Pic2":"' . $pi[1] . '",';
        $arr .= '"Pic3":"' . $pi[2] . '",';
        $arr .= '"Pic4":"' . $pi[3] . '",';
        $arr .= '"Pic5":"' . $pi[4] . '"}';
        }
      }
      break;
    default:
      break;
  }
  
  if ($search->num_rows < 100) {
    break;
  }
  
  $numrows -= 100;
  } else {
    break;
  }
}

$dbconn->close();

$arr .= ']';
echo $arr;
}
?>
