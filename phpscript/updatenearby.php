<?php
  $dbconn = new mysqli('localhost','austinpalmer','thereisnone1!','firesale');
  $dbconn->query('DELETE FROM nearby WHERE 1=1');
  $getcols = $dbconn->query('SELECT abbreviation,lat,lng from colleges ORDER BY name');
  while ($row = $getcols->fetch_assoc()) {
    $lat = $row['lat'];
    $lng = $row['lng'];
    $nam = $row['abbreviation'];
    $dbconn->query('INSERT INTO nearby(college) VALUES ("' . $nam . '")');

  $getnearby = 'SELECT (2 * 3959 * ASIN(SQRT(POW(SIN((RADIANS(' . $lat . ') - RADIANS(lat))/2),2) + COS(RADIANS(' . $lat . '))*COS(RADIANS(lat))*POW(SIN((RADIANS(' . $lng . ')-RADIANS(lng))/2),2)))) AS distance,abbreviation FROM colleges WHERE abbreviation!="' . $nam . '" ORDER BY distance LIMIT 5';
    $exnearby = $dbconn->query($getnearby);
    for ($i=0;$i<5;$i++) {
      $getrow = $exnearby->fetch_assoc();
      $dbconn->query('UPDATE nearby set near' . ($i+1) . '="' . $getrow['abbreviation'] . '" WHERE college="' . $nam . '"');
      echo $getrow['abbreviation'];
    }
    echo '<br>';
  }
?>