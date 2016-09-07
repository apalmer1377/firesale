<?php
session_start();
date_default_timezone_set('UTC');
$dbconn = new mysqli('localhost','austinpalmer','thereisnone1!','firesale');

$co = 'SELECT ID AS count from sublets ORDER BY ID DESC LIMIT 1';
$getco = $dbconn->query($co);
$getcoarr = $getco->fetch_assoc();
$numrows = $getcoarr['count'];
$lowrow = $numrows - 100;

$numres = 0;

$lat = $_GET['lat'];
$lng = $_GET['lng'];
$beds = $_GET['beds'];
$baths = $_GET['baths'];
if (!(empty($_GET['start_date']))) {
$start = $_GET['start_date'];
} else {
  $start = date('m-d-Y');
}
$endd = $_GET['end_date'];
$minrent = $_GET['minrent'];
$maxrent = $_GET['maxrent'];
$sort = $_GET['sort'];
$rad = $_GET['radius'];
$arr = '[';

$radres = 'SELECT (2 * 3959 * ASIN(SQRT(POW(SIN((RADIANS(' . $lat . ') - RADIANS(sublets.lat))/2),2) + COS(RADIANS(' . $lat . '))*COS(RADIANS(sublets.lat))*POW(SIN((RADIANS(' . $lng . ')-RADIANS(sublets.lng))/2),2)))) AS distance,sublets.* FROM sublets HAVING distance < 5';

switch($sort) {
  case 'bydist':
    $radres = 'SELECT (2 * 3959 * ASIN(SQRT(POW(SIN((RADIANS(' . $lat . ') - RADIANS(sublets.lat))/2),2) + COS(RADIANS(' . $lat . '))*COS(RADIANS(sublets.lat))*POW(SIN((RADIANS(' . $lng . ')-RADIANS(sublets.lng))/2),2)))) AS distance,sublets.* FROM sublets HAVING distance < ' . $rad . ' AND sublets.start_date >= ' . $start;
    
    if (!(empty($_GET['end_date']))) {
      $radres .= ' AND sublets.end_date <= ' . $endd; 
    }
    if ($_GET['minrent'] != 'default') {
      $radres .= ' AND sublets.rent >= ' . $minrent;
    }
    if ($_GET['maxrent'] != 'default') {
      $radres .= ' AND sublets.rent <= ' . $maxrent;
    }
    
    $radres .= ' ORDER BY distance';
    
    if ($_GET['beds'] != 'default') {
      $radres .= ', ( POW((' . $beds . '-sublets.beds),2) + ABS(' . $beds . '-sublets.beds) - (' . $beds . ' - sublets.beds) )';
    }
    
    if ($_GET['baths'] != 'default') {
      $radres .= ', ( POW((' . $baths . '-sublets.baths),2) + ABS(' . $baths . '-sublets.baths) - (' . $baths . ' - sublets.baths) )';
    }
    
    $radres .= ' LIMIT 100';
    
    break;
  case 'sizematch':
    $radres = 'SELECT (2 * 3959 * ASIN(SQRT(POW(SIN((RADIANS(' . $lat . ') - RADIANS(sublets.lat))/2),2) + COS(RADIANS(' . $lat . '))*COS(RADIANS(sublets.lat))*POW(SIN((RADIANS(' . $lng . ')-RADIANS(sublets.lng))/2),2)))) AS distance,sublets.* FROM sublets HAVING distance < ' . $rad . ' AND start_date >= ' . $start;
    if (!(empty($_GET['end_date']))) {
      $radres .= ' AND end_date <= ' . $endd; 
    }
    if ($_GET['minrent'] != 'default') {
      $radres .= ' AND rent >= ' . $minrent;
    }
    if ($_GET['maxrent'] != 'default') {
      $radres .= ' AND rent <= ' . $maxrent;
    }
    $radres .= ' ORDER BY';
    if ($_GET['beds'] != 'default') {
      $radres .= ' ( POW((' . $beds . '-beds),2) + ABS(' . $beds . '-beds) - (' . $beds . ' - beds) ),';
    }
    
    if ($_GET['baths'] != 'default') {
      $radres .= ' ( POW((' . $baths . '-baths),2) + ABS(' . $baths . '-baths) - (' . $baths . ' - baths) ),';
    }
    
    $radres .= ' distance';
    
    
    
    $radres .= ' LIMIT 100';
    
    break;
  case 'avmatch':
    $radres = 'SELECT (2 * 3959 * ASIN(SQRT(POW(SIN((RADIANS(' . $lat . ') - RADIANS(sublets.lat))/2),2) + COS(RADIANS(' . $lat . '))*COS(RADIANS(sublets.lat))*POW(SIN((RADIANS(' . $lng . ')-RADIANS(sublets.lng))/2),2)))) AS distance,sublets.* FROM sublets HAVING distance < ' . $rad . ' AND start_date >= ' . $start;
    if (!(empty($_GET['end_date']))) {
      $radres .= ' AND end_date <= ' . $endd; 
    }
    if ($_GET['minrent'] != 'default') {
      $radres .= ' AND rent >= ' . $minrent;
    }
    if ($_GET['maxrent'] != 'default') {
      $radres .= ' AND rent <= ' . $maxrent;
    }
    $radres .= ' ORDER BY';
    if (!(empty($_GET['end_date']))) {
      $radres .= ' ( POW((' . $start . ' - start_date),2) + POW((' . $endd . ' - end_date),2)),';
    }
    
    $radres .= ' distance';
    
    if ($_GET['beds'] != 'default') {
      $radres .= ', ( POW((' . $beds . '-beds),2) + ABS(' . $beds . '-beds) - (' . $beds . ' - beds) )';
    }
    
    if ($_GET['baths'] != 'default') {
      $radres .= ', ( POW((' . $baths . '-baths),2) + ABS(' . $baths . '-baths) - (' . $baths . ' - baths) )';
    }
    
    $radres .= ' LIMIT 100';
    
    break;
  default:
    break;
    
}


while ($numres <= 100) {

  $search = $dbconn->query($radres);
  
  while($row = $search->fetch_assoc()) {
  
    if ($row['pictures']==1) {
      $getaptpic = $dbconn->query('SELECT * FROM sublets_pictures WHERE ID="' . $row['ID'] . '"');
      $picapic = $getaptpic->fetch_assoc();
      for ($picia=0;$picia<5;$picia++) {
        if ($picapic['picture' . ($picia+1)] != '') {
          $picapicarray[$picia] = '../images/client/' . $picapic['posted_by'] . '/' . $picapic['picture' . ($picia+1)];
        } else {
          $picapicarray[$picia] = '';
        }
      }
    } else {
      $picapicarray = array();
    }
    $numres += 1;
    if ($arr!='[') {
      $arr .= ',';
    }
    $arr .= '{"Address":"' . $row['address'] . '",';
    $arr .= '"Apt":"' . $row['apt'] . '",';
    $arr .= '"City":"' . $row['city'] . '",';
    $arr .= '"State":"' . $row['state'] . '",';
    $arr .= '"Zip":"' . $row['zip'] . '",';
    $arr .= '"Rent":"' . $row['rent'] . '",';
    $arr .= '"Start":"' . $row['start_date'] . '",';
    $arr .= '"End":"' . $row['end_date'] . '",';
    $arr .= '"Beds":"' . $row['beds'] . '",';
    $arr .= '"Baths":"' . $row['baths'] . '",';
    $arr .= '"Description":"' . $row['description'] . '",';
    $arr .= '"Phone":"' . $row['phone'] . '",';
    $arr .= '"Email":"' . $row['email'] . '",';
    $arr .= '"College":"' . $row['college'] . '",';
    $arr .= '"Lat":"' . $row['lat'] . '",';
    $arr .= '"Lng":"' . $row['lng'] . '",';
    $arr .= '"Pic1":"' . $picapicarray[0] . '",';
    $arr .= '"Pic2":"' . $picapicarray[1] . '",';
    $arr .= '"Pic3":"' . $picapicarray[2] . '",';
    $arr .= '"Pic4":"' . $picapicarray[3] . '",';
    $arr .= '"Pic5":"' . $picapicarray[4] . '"}';
    
  }
  
  if ($search->num_rows < 100) {
    break;
  }
  
}

$arr .= ']';
echo $arr;

?>