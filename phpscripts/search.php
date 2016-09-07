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
$searcharray = array_diff(explode(" ",$searchfield),array('the','for','and','a','an'));
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
  $getres = 'SELECT * from ' . $type . ' WHERE (ID BETWEEN 1 AND ' . $numrows . ') AND college="' . $_SESSION['college'] . '" ORDER BY ID DESC LIMIT 100';
  $search = $dbconn->query($getres);

  switch($_GET['type']) {
    case 'books':
      while ($row = $search->fetch_assoc()) {
        
        $lookfor = str_replace(',','',str_replace('-',' ',strtolower(trim($row['name']))));
        if (preg_match($reg,$lookfor) != false) {
        $numres += 1;
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
        $arr .= '"College":"' . $row['college'] . '"}';
        }
      }
      
      break;

    case 'services':
      while ($row = $search->fetch_assoc()) {
        $lookfor = str_replace(',','',str_replace('-',' ',strtolower(trim($row['name']))));
        if (preg_match($reg,$lookfor) !== false) {
        $numres += 1;
        if ($arr != '[') {
          $arr .= ',';
        }
        $arr .= '{"Service":"' . $row['name'] . '",';
        $arr .= '"Price":"' . $row['price'] . '",';
        $arr .= '"Description":"' . $row['description'] . '",';
        $arr .= '"Phone":"' . $row['phone'] . '",';
        $arr .= '"Email":"' . $row['email'] . '",';
        $arr .= '"College":"' . $row['college'] . '"}';
        }
      }
      break;
    case 'miscellaneous':
      while ($row = $search->fetch_assoc()) {
        $lookfor = str_replace(',','',str_replace('-',' ',strtolower(trim($row['name']))));
        if (preg_match($reg,$lookfor) !== false) {
        $numres += 1;
        if ($arr != '[') {
          $arr .= ',';
        }
        $arr .= '{"Name":"' . $row['name'] . '",';
        $arr .= '"Price":"' . $row['price'] . '",';
        $arr .= '"Description":"' . $row['description'] . '",';
        $arr .= '"Phone":"' . $row['phone'] . '",';
        $arr .= '"Email":"' . $row['email'] . '",';
        $arr .= '"College":"' . $row['college'] . '"}';
        }
      }
      break;
    default:
      break;
  }
  
  if ($search->num_rows < 100) {
    break;
  }
}

$arr .= ']';
echo $arr;

?>
