<?php
  $dbconn = new mysqli('localhost','austinpalmer','thereisnone1!','firesale');
  echo $_GET['postid'];
  if (isset($_POST['testtitle'])) {
    $upqu = $dbconn->prepare('UPDATE textbooks SET name=?,author=?,price=?,description=? WHERE ID=' . $_POST['postid']);
    $upqu->bind_param('ssis',trim($_POST['testtitle']),trim($_POST['testauth']),trim($_POST['testpr']),trim($_POST['testde']));
    $upqu->execute();
    if (!(empty(trim($_POST['testpub'])))) {
      $upqu = $dbconn->prepare('UPDATE textbooks SET publisher=? WHERE ID=' . $_POST['postid']);
      $upqu->bind_param('s',trim($_POST['testpub']));
      $upqu->execute();
    }
    if (!(empty(trim($_POST['tested'])))) {
      $upqu = $dbconn->prepare('UPDATE textbooks SET edition=? WHERE ID=' . $_POST['postid']);
      $upqu->bind_param('s',trim($_POST['tested']));
      $upqu->execute();
    }
    if (!empty(trim($_POST['testtel']))) {
      $upqu = $dbconn->prepare('UPDATE textbooks SET phone=? WHERE ID=' . $_POST['postid']);
      $upqu->bind_param('s',trim($_POST['testtel']));
      $upqu->execute();
    }
    if (!empty(trim($_POST['testem']))) {
      $upqu = $dbconn->prepare('UPDATE textbooks SET email=? WHERE ID=' . $_POST['postid']);
      $upqu->bind_param('s',trim($_POST['testem']));
      $upqu->execute();
    }
    
  } else if (isset($_POST['testadd'])) {
    $upqu = $dbconn->prepare('UPDATE sublets SET address=?,city=?,state=?,zip=?,rent=?,beds=?,baths=?,start_date=?,end_date=?,lat=?,lng=?,description=? WHERE ID=' . trim($_POST['postid']));
    $upqu->bind_param('ssssiiisssss',trim($_POST['testadd']),trim($_POST['testcit']),trim($_POST['testst']),trim($_POST['testz']),trim($_POST['testpr']),trim($_POST['testbed']),trim($_POST['testbath']),trim($_POST['teststart']),trim($_POST['testend']),trim($_POST['testlat']),trim($_POST['testlng']),trim($_POST['testde']));
    $upqu->execute();
    if (!(empty(trim($_POST['testapt'])))) {
      $upqu = $dbconn->prepare('UPDATE sublets SET apt=? WHERE ID=' . trim($_POST['postid']));
      $upqu->bind_param('s',trim($_POST['testapt']));
      $upqu->execute();
    }
    if (!empty(trim($_POST['testtel']))) {
      $upqu = $dbconn->prepare('UPDATE sublets SET phone=? WHERE ID=' . $_POST['postid']);
      $upqu->bind_param('s',trim($_POST['testtel']));
      $upqu->execute();
    }
    if (!empty(trim($_POST['testem']))) {
      $upqu = $dbconn->prepare('UPDATE sublets SET email=? WHERE ID=' . $_POST['postid']);
      $upqu->bind_param('s',trim($_POST['testem']));
      $upqu->execute();
    }
  } else if (isset($_POST['testtyp'])) {
    $upqu = $dbconn->prepare('UPDATE misc SET name=?,type=?,price=?,description=?');
    $upqu->bind_param('ssis',trim($_POST['testnam']),trim($_POST['testtyp']),trim($_POST['testpr']),trim($_POST['description']));
    $upqu->execute();
    if (!empty(trim($_POST['testtel']))) {
      $upqu = $dbconn->prepare('UPDATE misc SET phone=? WHERE ID=' . $_POST['postid']);
      $upqu->bind_param('s',trim($_POST['testtel']));
      $upqu->execute();
    }
    if (!empty(trim($_POST['testem']))) {
      $upqu = $dbconn->prepare('UPDATE misc SET email=? WHERE ID=' . $_POST['postid']);
      $upqu->bind_param('s',trim($_POST['testem']));
      $upqu->execute();
    }
  } else {
    $upqu = $dbconn->prepare('UPDATE services SET name=?,price=?,description=?');
    $upqu->bind_param('sss',trim($_POST['testserv']),trim($_POST['testpr']),trim($_POST['description']));
    $upqu->execute();
    if (!empty(trim($_POST['testtel']))) {
      $upqu = $dbconn->prepare('UPDATE services SET phone=? WHERE ID=' . $_POST['postid']);
      $upqu->bind_param('s',trim($_POST['testtel']));
      $upqu->execute();
    }
    if (!empty(trim($_POST['testem']))) {
      $upqu = $dbconn->prepare('UPDATE services SET email=? WHERE ID=' . $_POST['postid']);
      $upqu->bind_param('s',trim($_POST['testem']));
      $upqu->execute();
    }
  }
?>